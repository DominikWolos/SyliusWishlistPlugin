<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusWishlistPlugin\Processor;

use BitBag\SyliusWishlistPlugin\Command\Wishlist\WishlistItem;
use BitBag\SyliusWishlistPlugin\Model\VariantPdfModel;
use BitBag\SyliusWishlistPlugin\Services\Generator\ModelCreatorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class VariantPdfModelProcessor implements VariantPdfModelProcessorInterface
{
    private ModelCreatorInterface $pdfModelCreator;

    public function __construct(ModelCreatorInterface $pdfModelCreator)
    {
        $this->pdfModelCreator = $pdfModelCreator;
    }

    public function createVariantPdfModelCollection(Collection $wishlistProducts): ArrayCollection
    {
        $pdfModelsCollection = new ArrayCollection();

        /** @var WishlistItem $wishlistProduct */
        foreach ($wishlistProducts as $wishlistProduct) {
            /** @var VariantPdfModel $variantPdfModel */
            $variantPdfModel = $this->pdfModelCreator->createWishlistItemToPdf($wishlistProduct);
            $pdfModelsCollection->add($variantPdfModel);
        }

        return $pdfModelsCollection;
    }
}
