<script>
import TitleComponent from "../components/TitleComponent.vue";
import dataTableComponent from "../components/dataTableComponent.vue";
import axios from "axios";

export default {
  name: "Opciones",
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
          key: "nombre",
          label: "Nombre",
          type: "text"
        // },
        // {
        //   key: "temario_id",
        //   label: "Temario",
        //   type: "number"
        // },
        // {
        //   key: "opciones_id",
        //   label: "Agencia",
        //   type: "text"
        // },
        // {
        //   key: "celular",
        //   label: "Celular",
        //   type: "text"
        // },
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
         },
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
      ],
      items: [],
    };
  },

  methods: {
    async listarPersonas() {
      const url = "http://127.0.0.1:8000/api/opciones";
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
      <TitleComponent title="Opciones" />
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
