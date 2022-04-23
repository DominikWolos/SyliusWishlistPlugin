<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusWishlistPlugin\Services\Exporter;

use BitBag\SyliusWishlistPlugin\Processor\VariantPdfModelProcessorInterface;
use Doctrine\Common\Collections\Collection;

final class WishlistToPdfExporter implements WishlistToPdfExporterInterface
{
    private VariantPdfModelProcessorInterface $variantPdfModelProcessor;

    private DomPdfWishlistExporterInterface $domPdfWishlistExporter;

    public function __construct(
        VariantPdfModelProcessorInterface $variantPdfModelProcessor,
        DomPdfWishlistExporterInterface $domPdfWishlistExporter
    ) {
        $this->variantPdfModelProcessor = $variantPdfModelProcessor;
        $this->domPdfWishlistExporter = $domPdfWishlistExporter;
    }

    public function createModelToPdfAndExportToPdf(Collection $wishlistProducts): void
    {
        $productsToExport = $this->variantPdfModelProcessor->createVariantPdfModelCollection($wishlistProducts);

        $this->domPdfWishlistExporter->export($productsToExport);
    }
}
