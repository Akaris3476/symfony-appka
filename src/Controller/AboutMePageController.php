<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Formatter\ApiResponseFormatter;
use App\Repository\InformationAboutMeRepository;

final class AboutMePageController extends AbstractController
{
    public function __construct(
        private InformationAboutMeRepository $aboutMeRepository,
        private ApiResponseFormatter $apiResponseFormatter,
    )
    {
    }

    #[Route('/about-me', name: 'app_about_me_page', methods: ['GET'])]
    public function showPage(): JsonResponse
    {
        $aboutMeData = $this->aboutMeRepository->findAll();

        foreach ($aboutMeData as $i => $value) {
            $transferedData[] = (array) $value;
        }

         return $this->apiResponseFormatter
             ->withData($transferedData)
             ->response();
    }
    
}
