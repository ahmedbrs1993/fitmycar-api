<?php

namespace App\Controller\Admin;

use App\Entity\ProductCompatibility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCompatibilityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCompatibility::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('fuelType', 'Compatibility')->autocomplete(),
            AssociationField::new('product')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Product Compatibility')
            ->setPageTitle(Crud::PAGE_NEW, 'Create Product Compatibility')
            ->setPageTitle(Crud::PAGE_EDIT, 'Edit Product Compatibility')
            ->setEntityLabelInSingular('Product Compatibility')
            ->setEntityLabelInPlural('Product Compatibility');
    }
}
