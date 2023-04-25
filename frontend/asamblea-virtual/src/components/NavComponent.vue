<script setup>
// defineProps({
//   title: {
//     type: String,
//     required: true,
//   },
// });
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link class="navbar-brand" to="/">
            <img src="/favicon.ico" width="30" height="30" alt="" />
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">
                        Inicio <span class="sr-only">(current)</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/persona"> Personas </router-link>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Gestiones
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <router-link class="dropdown-item" to="/asamblea">
                            Asambleas
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <router-link class="dropdown-item" to="/formulario">
                            Formularios
                        </router-link>
                    <router-link class="dropdown-item" to="/temario">
                        Temarios
                        </router-link>
                        <router-link class="dropdown-item" to="/opciones">
                            Opciones
                        </router-link>
                        <router-link class="dropdown-item" to="/opcion_temario">
                            Opciones temario
                        </router-link>
                    </div>
                </li>
                <!-- <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                          </li> -->
            </ul>
            <strong> Asamblea Virtual </strong>
        </div>
    </nav>
</template>

<style scoped></style>
