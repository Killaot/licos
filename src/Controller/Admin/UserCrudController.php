<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;



class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
        
    }


    public function configureFields(string $pageName): iterable
    {
        // Afficher l'id seulement dans la page détail
        yield IdField::new('id')->onlyOnDetail();
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield TelephoneField::new('telephone');
        yield TextField::new('password');
        yield EmailField::new('email'); 
        yield ArrayField::new('roles');
        yield AssociationField::new("unAdmin")->renderAsNativeWidget();
    }
}
