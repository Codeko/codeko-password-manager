<?php

namespace Application\Sonata\UserBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class PasswordVoter implements VoterInterface {

    const VERPASSWORD = 'ROLE_MOSTRAR_PASSWORD';
    const EDITARPASSWORD = 'ROLE_EDITAR_PASSWORD';
    const BORRARPASSWORD = 'ROLE_BORRAR_PASSWORD';

    public function supportsAttribute($attribute) {
        return in_array($attribute, array(
            self::VERPASSWORD,
            self::EDITARPASSWORD,
            self::BORRARPASSWORD,
        ));
    }

    public function supportsClass($class) {
        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes) {

        $vote = VoterInterface::ACCESS_ABSTAIN;

        foreach ($attributes as $attribute) {
            if (false === $this->supportsAttribute($attribute)) {
                continue;
            }

            $vote = VoterInterface::ACCESS_DENIED;

            if ($attribute === 'ROLE_EDITAR_PASSWORD' || $attribute === 'ROLE_BORRAR_PASSWORD') {
                $user = $token->getUser();
                $iduser = $user->getId();
                $idpasswordPropietario = $object->getUser()->getId();

                if (!$user->isSuperAdmin()) {

                    // Comprobar que la PASSWORD que se edita fue publicada por mismo usuario
                    /* @var $idpassword type */
                    if ($idpasswordPropietario != $iduser) {
                        $vote = VoterInterface::ACCESS_DENIED;
                        throw new \InvalidArgumentException(
                        'No eres el propietario'
                        );
                    }
                    
                }
            }
        }

        return $vote;
    }

}
