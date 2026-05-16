<?php

function rutaInicioPorRol(?string $rol = null): string
{
    $rol ??= session()->get("usuario.rol");

    return $rol === "cliente" ? "/rifas/catalogo" : "/usuarios";
}

function seguridad($rol =array()){
    if(!session()->has("usuario")){
        return redirect()->to("/usuarios/login")->with("error","Inicia sesión para acceder a esta página");
    }

   
    if($rol){
        $encontrado = false;
        foreach ($rol as $r) {
            if(session()->get("usuario.rol") == $r){
                $encontrado = true;
            }
            
        }
        if(!$encontrado){
            return redirect()->to(rutaInicioPorRol())->with("error","No tienes permisos para acceder a esta página");
        }
    }





}

function noSeguridad(){
    if(session()->has("usuario")){
        return redirect()->to(rutaInicioPorRol());
    }
}

