<?php

namespace Application\Sonata\UserBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Application\Sonata\UserBundle\Security\Permits\Permits;

class PasswordVoter extends Permits implements VoterInterface {

    const VERPASSWORD = 'ROLE_LISTAR_ENTIDAD';
    const EDITARPASSWORD = 'ROLE_EDITAR_ENTIDAD';
    const BORRARPASSWORD = 'ROLE_BORRAR_ENTIDAD';
    const EDITARUSUARIO = 'ROLE_EDITAR_USUARIO';
    const EDITARMULTIMEDIA = 'ROLE_EDITAR_MULTIMEDIA';
    const BORRARMULTIMEDIA = 'ROLE_BORRAR_MULTIMEDIA';

    public function supportsAttribute($attribute) {
        return in_array($attribute, array(
            self::VERPASSWORD,
            self::EDITARPASSWORD,
            self::BORRARPASSWORD,
            self::EDITARUSUARIO,
            self::EDITARMULTIMEDIA,
            self::BORRARMULTIMEDIA,
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
            $user = $token->getUser();
            $iduser = $user->getId();

            if ($attribute === 'ROLE_EDITAR_ENTIDAD' || $attribute === 'ROLE_BORRAR_ENTIDAD') {

                $idpasswordPropietario = $object->getUser()->getId();
                $contraseñaId = $object->getId();
                $IdsPassEscritura = $this->getWritePermits($iduser);
                $tamañoPassEscritura = count($IdsPassEscritura);

                if (!$user->isSuperAdmin()) {

                    /* @var $idpasswordPropietario type */
                    if ($idpasswordPropietario != $iduser) {
                        $vote = VoterInterface::ACCESS_DENIED;
                    } else {
                        $vote = VoterInterface::ACCESS_GRANTED;
                    }

                    //Comprobar permisos de escritura
                    for ($i = 0; $i < $tamañoPassEscritura; $i++) {
                        if ($IdsPassEscritura[$i] == $contraseñaId) {
                            $vote = VoterInterface::ACCESS_GRANTED;
                        }
                    }

                    return $vote;
                } else {
                    $vote = VoterInterface::ACCESS_GRANTED;
                    return $vote;
                }
            }

            if ($attribute === 'ROLE_EDITAR_MULTIMEDIA' || $attribute === 'ROLE_BORRAR_MULTIMEDIA') {

                if (!$user->isSuperAdmin()) {
                    if ($idpasswordPropietario != $iduser) {
                        $vote = VoterInterface::ACCESS_DENIED;
                        return $vote;
                    }
                    $vote = VoterInterface::ACCESS_GRANTED;
                    return $vote;
                } else {
                    $vote = VoterInterface::ACCESS_GRANTED;
                    return $vote;
                }
            }

            if ($attribute === 'ROLE_EDITAR_USUARIO') {
                
                $idUsuarioPropietario = $object->getId();
                
                if (!$user->isSuperAdmin()) {

                    if ($idUsuarioPropietario != $iduser) {
                        $vote = VoterInterface::ACCESS_DENIED;
                        return $vote;
                    }
                    $vote = VoterInterface::ACCESS_GRANTED;
                    return $vote;
                } else {
                    $vote = VoterInterface::ACCESS_GRANTED;
                    return $vote;
                }
            }
        }

        return $vote;
    }

}
