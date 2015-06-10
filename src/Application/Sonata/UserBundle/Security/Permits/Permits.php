<?php

namespace Application\Sonata\UserBundle\Security\Permits;

class Permits {

    function getWritePermits($user, $userId) {
        $contenedorPassEscritura = array();

        $permisosUser = $this->getUserPermits($userId);
        foreach ($permisosUser as $valor) {
            if ($this->checkReadPermits($valor["permisos"])) {
                if ($this->checkWritePermits($valor["permisos"])) {
                    array_push($contenedorPassEscritura, intval($valor["password_id"]));
                }
            }
        }

        $permisosGrupos = $this->getGroupPermits($userId);
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

    function getUserPermits($userId) {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM PermisoUser WHERE user_id = '" . $userId . "'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getGroupPermits($userId) {
        $connection = $this->getConnection();
        $sql = "SELECT PermisoGrupo.grupo_id, PermisoGrupo.password_id, PermisoGrupo.permisos, fos_user_user_group.user_id, fos_user_user_group.group_id FROM PermisoGrupo INNER JOIN fos_user_user_group ON fos_user_user_group.user_id=" . $userId . " WHERE fos_user_user_group.group_id=PermisoGrupo.grupo_id";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    protected function getConnection() {
        return $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager()->getConnection();
    }

    /*
      Permisos [Lectura|Escritura]:
      Leer y escribir - 11
      Leer y no escribir - 10
      No leer y no escribir - 0
     */

    function checkReadPermits($permiso) {
        if ($permiso == 11) {
            return true;
        } else if ($permiso == 10) {
            return true;
        } else {
            return false;
        }
    }

    function checkWritePermits($permiso) {
        if ($permiso == 11) {
            return true;
        } else {
            return false;
        }
    }

}
