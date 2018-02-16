<?php

use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\ProductionType\ProductionType;
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
        $this->repo->save(new ProductionType($this->repo->nextId(), 'Webシステム'));
        $this->repo->save(new ProductionType($this->repo->nextId(), '業務システム'));
        $this->repo->save(new ProductionType($this->repo->nextId(), 'アプリ'));
        $this->repo->save(new ProductionType($this->repo->nextId(), 'Webサイト'));
        $this->repo->save(new ProductionType($this->repo->nextId(), '映像'));
        $this->repo->save(new ProductionType($this->repo->nextId(), '2Dゲーム'));
        $this->repo->save(new ProductionType($this->repo->nextId(), '3Dゲーム'));
        $this->repo->save(new ProductionType($this->repo->nextId(), 'プロダクションデザイン'));
        $this->repo->save(new ProductionType($this->repo->nextId(), 'イラスト'));

    }
}