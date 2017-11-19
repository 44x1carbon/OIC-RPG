<?php

use App\Domain\Course\Course;
use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use Illuminate\Database\Seeder;

class ProductionTypeSeeder extends Seeder
{
    /* @var ProductionTypeRepositoryInterface $repo */
    protected $repo;

    /* @var ProductionTypeFactory $factory*/
    protected $factory;

    function __construct()
    {
        $this->repo = app(ProductionTypeRepositoryInterface::class);
        $this->factory = app(ProductionTypeFactory::class);
    }

    public function run()
    {
        $this->repo->save($this->factory->createProductionType('システム'));
        $this->repo->save($this->factory->createProductionType('映像'));
    }
}