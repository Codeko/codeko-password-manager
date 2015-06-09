<?php

namespace Application\Sonata\UserBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class PasswordVoter implements VoterInterface {

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

            if ($attribute === 'ROLE_EDITAR_ENTIDAD' || $attribute === 'ROLE_BORRAR_ENTIDAD') {
                $user = $token->getUser();
                $iduser = $user->getId();
                $idpasswordPropietario = $object->getUser()->getId();
                $contraseñaId = $object->getId();
                $IdsPassEscritura = $this->getWritePermits($user, $iduser);
                $tamañoPassEscritura = count($IdsPassEscritura);

                if (!$user->isSuperAdmin()) {

                    /* @var $idpasswordPropietario type */
                    if ($idpasswordPropietario != $iduser) {
                        $vote = VoterInterface::ACCESS_DENIED;
                    }

                    //Comprobar permisos de escritura
                    for ($i = 0; $i < $tamañoPassEscritura; $i++) {
                        if ($IdsPassEscritura[$i] == $contraseñaId) {
                            $vote = VoterInterface::ACCESS_GRANTED;
                        }
                    }

                    $permisosEscritura = $this->getWritePermits($user, $iduser);

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

//            if ($attribute === 'ROLE_LISTAR_ENTIDAD') {
//
//                if (!$user->isSuperAdmin()) {
//
//                    if ($idpasswordPropietario != $iduser) {
//                        $vote = VoterInterface::ACCESS_DENIED;
//                        return $vote;
//                    }
//                    $vote = VoterInterface::ACCESS_GRANTED;
//                    return $vote;
//                } else {
//                    $vote = VoterInterface::ACCESS_GRANTED;
//                    return $vote;
//                }
//            }
        }

        return $vote;
    }

    protected function getWritePermits($user, $userId) {
        $connection = $this->getConnection();
        $contenedorPassEscritura = array();

        $permisosUser = $this->getUserPermits($userId, $connection);
        foreach ($permisosUser as $valor) {
            if ($this->checkReadPermits($valor["permisos"])) {
                if ($this->checkWritePermits($valor["permisos"])) {
                    array_push($contenedorPassEscritura, intval($valor["password_id"]));
                }
            }
        }

        $permisosGrupos = $this->getGroupPermits($userId, $connection);
        foreach ($permisosGrupos as $valor) {
            if ($this->checkReadPermits($valor["permisos"])) {
                if ($this->checkWritePermits($valor["permisos"])) {
                    array_push($contenedorPassEscritura, intval($valor["password_id"]));
                }
            }
        }

        $IdsPassEscritura = array_unique($contenedorPassEscritura);
        return $IdsPassEscritura;
    }

    protected function getUserPermits($userId, $connection) {
        $sql = "SELECT * FROM PermisoUser WHERE user_id = '" . $userId . "'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    protected function getGroupPermits($userId, $connection) {
        $sql = "SELECT PermisoGrupo.grupo_id, PermisoGrupo.password_id, PermisoGrupo.permisos, fos_user_user_group.user_id, fos_user_user_group.group_id FROM PermisoGrupo INNER JOIN fos_user_user_group ON fos_user_user_group.user_id=" . $userId . " WHERE fos_user_user_group.group_id=PermisoGrupo.grupo_id";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    protected function getConnection() {
        return $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager()->getConnection();
    }

    protected function checkReadPermits($permiso) {
        if ($permiso == 11) {
            return true;
        } else if ($permiso == 10) {
            return true;
        } else {
            return false;
        }
    }

    protected function checkWritePermits($permiso) {
        if ($permiso == 11) {
            return true;
        } else {
            return false;
        }
    }

}
