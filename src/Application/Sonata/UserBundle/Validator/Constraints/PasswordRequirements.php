<?php

/*
 * This file is part of the RollerworksPasswordStrengthBundle package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Application\Sonata\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordRequirements extends Constraint
{
    public $tooShortMessage = 'Su contraseña debe tener al menos {{length}} caracteres.';
    public $missingLettersMessage = 'Su contraseña debe incluir al menos una letra.';
    public $requireCaseDiffMessage = 'Su contraseña debe incluir letras mayúsculas y minúsculas.';
    public $missingNumbersMessage = 'Su contraseña debe incluir al menos un número.';
    public $missingSpecialCharacterMessage = 'Su contraseña debe contener al menos un caracter especial.';

    public $minLength = 6;
    public $requireLetters = true;
    public $requireCaseDiff = false;
    public $requireNumbers = false;
    public $requireSpecialCharacter = false;
}
