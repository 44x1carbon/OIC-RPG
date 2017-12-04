<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 16:50
 */

namespace Tests\Repository;


use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use Tests\TestCase;

class ProductionIdeaRepositoryTest extends TestCase
{
    /* @var ProductionIdeaRepositoryInterface $productionIdeaRepository */
    protected $productionIdeaRepository;
    protected $productionTypeRepository;
    protected $productionIdeaFactory;
    protected $productionTypeFactory;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->productionIdeaRepository = app(ProductionIdeaRepositoryInterface::class);
        $this->productionTypeRepository = app(ProductionTypeRepositoryInterface::class);
        $this->productionIdeaFactory = new ProductionIdeaFactory();
        $this->productionTypeFactory = app(ProductionTypeFactory::class);
        $productionType = $this->productionTypeFactory->createProductionType("サービス");
        $productionType2 = $this->productionTypeFactory->createProductionType("映像");
        $this->productionTypeRepository->save($productionType);
        $this->productionTypeRepository->save($productionType2);
    }

    public function testSave()
    {
        $id = new ProductionIdeaId("11");
        $productionTheme = "IT";
//        $productionTypeId = "1";
        $productionType = $this->productionTypeRepository->findByName("サービス");
        $description = "説明です";

        $productionIdeaFactory = new ProductionIdeaFactory();
        $productionIdea = $productionIdeaFactory->createProductionIdea($productionTheme, $productionType, $description, $id);
        $this->productionIdeaRepository->save($productionIdea);

        $findProductionIdea = $this->productionIdeaRepository->findById($id);
        $afterDescription = "改変した説明1です";
        $findProductionIdea->setIdeaDescription($afterDescription);
        $this->productionIdeaRepository->save($findProductionIdea);

        $findAfterProductionIdea = $this->productionIdeaRepository->findById($id);
        $this->assertTrue($findAfterProductionIdea->ideaDescription() === $afterDescription);
    }

    public function testFindById()
    {
        // ProductionIdeaのデータ1を追加
        $productionTheme = "IT";
//        $productionTypeId = "1";
        $productionType = $this->productionTypeRepository->findByName("サービス");
        $description = "説明1です";
        $productionIdea = $this->productionIdeaFactory->createProductionIdea($productionTheme, $productionType, $description);
        $this->productionIdeaRepository->save($productionIdea);

        // ProductionIdeaのデータ2を追加
        $productionTheme2 = "映像";
//        $productionTypeId2 = "2";
        $productionType2 = $this->productionTypeRepository->findByName("映像");
        $description2 = "説明2です";
        $productionIdea2 = $this->productionIdeaFactory->createProductionIdea($productionTheme2, $productionType2, $description2);
        $this->productionIdeaRepository->save($productionIdea2);

        // 保存した
        $findProductionIdea = $this->productionIdeaRepository->findById($productionIdea->id());
        $result = $findProductionIdea->id()->equals($productionIdea->id())  && $findProductionIdea->ideaDescription() === $productionIdea->ideaDescription();
        $this->assertTrue($result);
        $findProductionIdea2 = $this->productionIdeaRepository->findById($productionIdea2->id());
        $result2 = $findProductionIdea2->id()->equals($productionIdea2->id()) && $findProductionIdea2->ideaDescription() === $productionIdea2->ideaDescription();
        $this->assertTrue($result2);

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->productionIdeaRepository->findById(new ProductionIdeaId('80')) === null);
    }
}