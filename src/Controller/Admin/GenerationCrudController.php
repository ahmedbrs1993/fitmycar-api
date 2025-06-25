<?php

namespace App\Controller\Admin;

use App\Entity\Generation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GenerationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Generation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Generations');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('model', 'Brand - Model')
                ->autocomplete()
                ->setFormTypeOption('disabled', $pageName === Crud::PAGE_EDIT),
            TextField::new('name', 'Generation'),
        ];
    }
}
