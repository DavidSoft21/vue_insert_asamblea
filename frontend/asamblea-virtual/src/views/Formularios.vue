<script>
import TitleComponent from "../components/TitleComponent.vue";
import dataTableComponent from "../components/dataTableComponent.vue";
import axios from "axios";

export default {
  name: "Formularios",
  components: {
    dataTableComponent,
    TitleComponent,
  },

  created() {
    this.listarPersonas();
  },

  data() {

   
    return {
      fields: [
        {
          key: "id",
          label: "ID",
          type: "number"
        },
        {
          key: "nombre_formulario",
          label: "nombre_formulario",
          type: "text"
        },
    
        {
          key: "fecha",
          label: "fecha",
          type: "text"
        },
        // {
        //   key: "estado_personas_id",
        //   label: "Estado",
        //   type: "select",
        //   options: [   { value: 1, text: 'Activo' },{ value: 2, text: 'Inactivo' }, { value: 3, text: 'Fallecido' }]
        // },
        // {
        //   key: "correo",
        //   label: "Correo",
        //   type: "text"
        // },
        // {
        //   key: "grupo",
        //   label: "Grupo",
        //   type: "text",
        // },
        // {
        //   key: "rol_id",
        //   label: "Rol",
        //   type: "select",
        //   options: [   { value: 1, text: 'Consejero' },{ value: 2, text: 'Delegado' }, { value: 3, text: 'Suplente' }]
        // },
        { 
          key: "edit", 
          label: "",
          type: "edit"
        },
        { 
          key: "delete", 
          label: "",
          type: "delete"
        },
        { 
          key: "ver", 
          label: "",
          type: "ver"
        },
      ],
      items: [],
    };
  },

  methods: {
    async listarPersonas() {
      const url = "http://127.0.0.1:8000/api/formulario_detalle";
      const optionsRequest = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };

      axios
        .get(url, optionsRequest)
        .then((response) =>
  
          response.data.map((row) => {
            row.isEdit = false;
            this.items.push(row);
          })
        )
        .catch(console.log)
        .finally(console.log);
    },
  },
};
</script>
<template>
  <div class="children">
    <div id="contenido">
      <TitleComponent title="Formularios" />
      <dataTableComponent v-model="items" :fields="fields"></dataTableComponent>
    </div>
  </div>
</template>
<style scoped>
#contenido {
  margin: auto;
  width: 100%;
}
</style>
