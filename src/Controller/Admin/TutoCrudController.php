<?php

namespace App\Controller\Admin;

use App\Entity\Tuto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\DateTime;

class TutoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tuto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('Auteur'),
            DateTimeField::new('created_at')->onlyWhenCreating(),
            ImageField::new('images')->setUploadDir('public/uploads/tuto/'),
        ];
    }
    
}
