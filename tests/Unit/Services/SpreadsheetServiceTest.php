<?php

namespace Tests\Unit\Services;

use App\Jobs\ProcessProductImage;
use App\Models\Product;
use App\Services\SpreadsheetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SpreadsheetServiceTest extends TestCase
{
    use RefreshDatabase;

    protected SpreadsheetService $service;

    protected string $fakePath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SpreadsheetService;
        $this->fakePath = '/fake/path/to/spreadsheet.csv';
    }

    /** @test */
    public function it_creates_products_with_valid_data_and_dispatches_jobs()
    {
        Queue::fake();

        $this->service->processSpreadsheet($this->fakePath);

        $this->assertDatabaseCount('products', 2); // P001 & P002 only
        $this->assertDatabaseHas('products', ['product_code' => 'P001']);
        $this->assertDatabaseHas('products', ['product_code' => 'P002']);
        $this->assertDatabaseMissing('products', ['product_code' => 'P003']); // quantity = 0
        $this->assertDatabaseMissing('products', ['product_code' => 'P004']); // quantity = 3, but duplicate test handled below

        Queue::assertPushed(ProcessProductImage::class, 2);
        Queue::assertPushed(function (ProcessProductImage $job) {
            return in_array($job->product->product_code, ['P001', 'P002']);
        });
    }

    /** @test */
    public function it_skips_rows_with_invalid_quantity()
    {
        Queue::fake();

        $this->service->processSpreadsheet($this->fakePath);

        $this->assertDatabaseMissing('products', ['product_code' => 'P003']); // quantity = 0
    }

    /** @test */
    public function it_skips_duplicate_product_code()
    {
        Queue::fake();

        // First run to insert product with code = P001
        Product::factory()->create(['product_code' => 'P001']);

        $this->service->processSpreadsheet($this->fakePath);

        // Now P001 is skipped (already exists), only P002 inserted
        $this->assertDatabaseCount('products', 2); // existing P001 + new P002
        $this->assertDatabaseHas('products', ['product_code' => 'P002']);
        Queue::assertPushed(ProcessProductImage::class, 1);
    }
}
