<?php

namespace Skrepka\CategoryBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\CategoryBundle\Document\Category;

class LoadCategoryData implements FixtureInterface, OrderedFixtureInterface
{
    public $manager;

    public function getOrder()
    {
        return 1;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $parentCategory = $this->persistCategory('IT-компании', null);
        $this->persistCategory('Разработка ПО', $parentCategory);
        $this->persistCategory('Разработка сайтов', $parentCategory);
        $this->persistCategory('Продвижение сайтов (SEO)', $parentCategory);

        /////////////////////////////////////////
        $parentCategory = $this->persistCategory('Образование', null);
        $this->persistCategory('Детские сады', $parentCategory);
        $this->persistCategory('ВУЗы', $parentCategory);
        $this->persistCategory('Техникумы', $parentCategory);
        $this->persistCategory('Школы', $parentCategory);

        /////////////////////////////////////////
        $parentCategory = $this->persistCategory('Производство', null);
        $this->persistCategory('Промышленные товары', $parentCategory);
        $this->persistCategory('Мебель', $parentCategory);
        $this->persistCategory('Продукты питания', $parentCategory);
        $this->persistCategory('Пивзаводы', $parentCategory);
        $this->persistCategory('Легкая промышленность', $parentCategory);
        $this->persistCategory('Машиностроение', $parentCategory);
        $this->persistCategory('Деревообработка', $parentCategory);
        $this->persistCategory('Металлообработка', $parentCategory);
        $this->persistCategory('Оборудование пищевой промышленности', $parentCategory);
        $this->persistCategory('Торговое оборудование', $parentCategory);
        $this->persistCategory('Оборудование', $parentCategory);
        $this->persistCategory('Комплектующие', $parentCategory);
        $this->persistCategory('Одежда', $parentCategory);
        $this->persistCategory('Обувь', $parentCategory);
        $this->persistCategory('Ткани', $parentCategory);
        $this->persistCategory('Полиграфия', $parentCategory);
        $this->persistCategory('Приборостроение', $parentCategory);
        $this->persistCategory('Электротехника', $parentCategory);
        $this->persistCategory('Стройматериалы', $parentCategory);
        $this->persistCategory('Тара и упаковка', $parentCategory);
        $this->persistCategory('Химическая продукция', $parentCategory);
        $this->persistCategory('Лакокрасочные материалы', $parentCategory);

        /////////////////////////////////////////
        $parentCategory = $this->persistCategory('Работа и трудоустройство', null);
        $this->persistCategory('Трудоустройство', $parentCategory);
        $this->persistCategory('Профессиональные курсы', $parentCategory);
        $this->persistCategory('Кадровые агенства', $parentCategory);

        /////////////////////////////////////////
        $parentCategory = $this->persistCategory('Сельское хозяйство', null);
        $this->persistCategory('Посевной материал', $parentCategory);
        $this->persistCategory('Удобрения', $parentCategory);
        $this->persistCategory('Саженцы', $parentCategory);
        $this->persistCategory('Сельхозтехника', $parentCategory);
        $this->persistCategory('Сельхозпродукция', $parentCategory);
        $this->persistCategory('Инвентарь', $parentCategory);
        $this->persistCategory('Оборудование', $parentCategory);
        $this->persistCategory('Средства для защиты растений', $parentCategory);

        $manager->flush();
    }

    /**
     * Create category
     *
     * @param $name
     * @param $parentCategory
     * @return Category
     */
    private function persistCategory($name, $parentCategory)
    {
        $category = new Category();
        $category->setName($name);
        $category->setParent($parentCategory);
        $this->manager->persist($category);

        return $category;
    }
}