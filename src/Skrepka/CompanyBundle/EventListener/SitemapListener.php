<?php

namespace Skrepka\CompanyBundle\EventListener;

use Skrepka\CategoryBundle\Document\CategoryRepository;
use Skrepka\CompanyBundle\Document\CompanyRepository;
use Symfony\Component\Routing\RouterInterface;

use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapListener implements SitemapListenerInterface
{
    private $router;
    private $categoryRepo;
    private $companyRepo;

    public function __construct(RouterInterface $router, CategoryRepository $categoryRepo, CompanyRepository $companyRepo)
    {
        $this->router = $router;

        /** @var categoryRepo  */
        $this->categoryRepo = $categoryRepo;

        /** @var companyRepo  */
        $this->companyRepo = $companyRepo;
    }

    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();
        if (is_null($section) || $section == 'default') {
            //get absolute homepage url
            $url = $this->router->generate('homepage', [], true);

            //add homepage url to the urlset named default
            $event->getGenerator()->addUrl(new UrlConcrete($url, new \DateTime(), UrlConcrete::CHANGEFREQ_DAILY, 1), 'default');

            $categories =  $this->categoryRepo->all();
            foreach($categories As $category) {
                if (!is_null($category->getParent())) {
                    $url = $this->router->generate('companies_for_category', ['slug' => $category->getSlug()], true);
                    $event->getGenerator()->addUrl(new UrlConcrete($url, new \DateTime(), UrlConcrete::CHANGEFREQ_DAILY, 0.80), 'default');
                }
            }

            $companies =  $this->companyRepo->all()->getQuery()->execute();
            foreach($companies As $company) {
                $url = $this->router->generate('company_show', ['slug' => $company->getSlug()], true);
                $event->getGenerator()->addUrl(new UrlConcrete($url, new \DateTime(), UrlConcrete::CHANGEFREQ_DAILY, 0.80), 'default');
            }
        }
    }
}