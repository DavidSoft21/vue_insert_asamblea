<template>
  <div class="container" id="table-content">
    <div class="table-container">
      <!--Modal-->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Importar Excel</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <div class="form-group-row p-3">
                  <h3>Cargar Excel</h3>
                </div>

                <div class="form-group-row">
                  <div class="col-sm-10">
                    <input
                      type="file"
                      id="file"
                      ref="file"
                      v-on:change="handleFileUpload()"
                      accept=".XLSX, .CSV"
                      class="form-control p-1"
                    />
                  </div>
                </div>

                <br />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal"
                >
                  CANCELAR
                </button>
                <button
                  type="button"
                  v-on:click="EventUpload()"
                  class="btn btn-success"
                >
                  GUARDAR
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--Modal-->

      <!--Modal-->
      <div
        class="modal fade"
        id="exampleModal_formulario"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 id="title" style="text-align: center"></h3>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formulario_respuestas">
              <div class="modal-body">
                <div class="form-group-row p-3">
                  <h5 id="fecha"></h5>
                  <b-form-select
                    v-model="selected_participantes"
                    :options="options"
                    size="sm"
                    class="mt-3"
                  ></b-form-select>
                  <div class="mt-3">
                    Selected: <strong>{{ selected_participantes }}</strong>
                  </div>
                </div>

                <div class="form-group-row d-flex justify-content-center">
                  <div class="col-sm-10">
                    <div id="example-1">
                      <span v-for="(formDato, index) in formDatos">
                        <span v-for="(frm, i) in formDato">
                          <div>
                            {{ formDato[i][index].nombre_termario }}
                            <div v-for="(frm, j) in formDato[i]">
                              <b-form-radio
                                v-if="frm.type === 'radio'"
                                class="frm_respuestas"
                                :key="j"
                                :name="text_ + formDato[i][index].id"
                                :value="frm.opcion_id"
                                >{{ frm.nombre_opcion }}
                              </b-form-radio>

                              <b-form-checkbox
                                v-if="frm.type === 'checkbox'"
                                class="frm_respuestas"
                                :key="j"
                                :name="text_ + formDato[i][index].id"
                                :value="frm.opcion_id"
                                >{{ frm.nombre_opcion }}
                              </b-form-checkbox>

                              <b-form-textarea
                                v-if="frm.type === 'textarea'"
                                class="frm_respuestas"
                                :key="j"
                                placeholder="Ingresa tu respuesta"
                                :name="text_ + formDato[i][index].id"
                              >
                              </b-form-textarea>

                              <input
                                type="hidden"
                                id="frm_id"
                                :value="formDato[i]['formulario_id']"
                                class="frm_respuestas"
                              />
                            </div>
                          </div>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
                <br />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal"
                >
                  CANCELAR
                </button>
                <button type="submit" class="btn btn-success">GUARDAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--Modal-->

      <div class="d-flex justify-content-start mb-2">
        <b-button size="lg" variant="outline-success" @click="addRowHandler"
          >Crear</b-button
        >
        <b-button
          v-if="this.showBtnRows"
          size="lg"
          variant="outline-danger"
          @click="removeRowsHandler"
          >Eliminar Filas</b-button
        >
        <button
          type="button"
          class="btn btn-outline-primary"
          data-toggle="modal"
          data-target="#exampleModal"
        >
          Importar Excel
        </button>
      </div>

      <b-table
        :items="tableItems"
        :fields="fields"
        id="my-table"
        :per-page="perPage"
        :current-page="currentPage"
        small
      >
        <template
          v-for="(field, index) in fields"
          #[`cell(${field.key})`]="data"
        >
          <b-form-datepicker
            v-if="field.type === 'date' && tableItems[data.index].isEdit"
            :key="index"
            :type="field.type"
            :value="tableItems[data.index][field.key]"
            @input="(value) => inputHandler(value, data.index, field.key)"
          ></b-form-datepicker>
          <b-form-select
            v-if="field.type === 'select' && tableItems[data.index].isEdit"
            :key="index"
            :value="tableItems[data.index][field.key]"
            @input="(value) => inputHandler(value, data.index, field.key)"
            :options="field.options"
          ></b-form-select>
          <b-form-input
            v-if="field.type == 'text' && tableItems[data.index].isEdit"
            :key="index"
            :type="field.type"
            :value="tableItems[data.index][field.key]"
            @blur="(e) => inputHandler(e.target.value, data.index, field.key)"
          ></b-form-input>

          <b-checkbox
            v-if="field.key === 'selectRow'"
            :checked="tableItems[data.index].isSelected"
            @change="selectRowHandler(data)"
          ></b-checkbox>

          <b-form-input
            v-if="
              field.type == 'number' &&
              tableItems[data.index].isEdit &&
              field.key != 'id'
            "
            :key="index"
            :type="field.type"
            :value="tableItems[data.index][field.key]"
            @blur="(e) => inputHandler(e.target.value, data.index, field.key)"
          ></b-form-input>

          <span v-if="!tableItems[data.index].isEdit">{{ data.value }}</span>

          <div
            class="btn-group btn-group-lg"
            role="group"
            aria-label="acciones"
          >
            <b-button
              pill
              variant="warning pill"
              v-if="field.type === 'edit'"
              @click="editRowHandler(data)"
            >
              <span v-if="!tableItems[data.index].isEdit">Editar</span>
              <span v-else>Guardar</span>
            </b-button>
            <b-button
              pill
              variant="danger pill"
              v-if="field.type === 'delete'"
              @click="removeRowHandler(data.index)"
            >
              <span>Borrar</span>
            </b-button>

            <b-button
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#exampleModal_formulario"
              pill
              variant="primary pill"
              v-if="field.type === 'ver'"
              @click="showRowsHandler(data)"
            >
              <span>Ver</span>
            </b-button>
          </div>
        </template>
      </b-table>
      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="my-table"
      ></b-pagination>

      <p class="mt-3">Pagina Actual: {{ currentPage }}</p>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "dataTableComponent",
  components: {},
  props: {
    value: Array,
    fields: Array,
  },

  mounted() {
    document
      .getElementById("formulario_respuestas")
      .addEventListener("submit", (e) => {
        alert("datos enviado!!!");
        e.preventDefault();

        const arr_respuestas = [];
        const inputs = document.querySelectorAll(".frm_respuestas");
        const frm_id = document.getElementById("frm_id").value;

        let temario_id = null;
        const url = "http://127.0.0.1:8000/api/formulario";

        inputs.forEach((element, index) => {
          if (element.children.length > 0) {
            if (element.children[0].checked == true) {
              const optionsRequest = {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
              };
              const url = "http://127.0.0.1:8000/api/formulario";
              let pregunta = element.children[0].name;
              let pregunta_id = pregunta.substr(5, 4);

              axios
                .post(
                  url,
                  {
                    persona_id: this.selected_participantes,
                    temario_id: pregunta_id,
                    opciones_id: element.children[0].value,
                    formulario_detalle_id: frm_id,
                  },
                  {
                    headers: {
                      "Content-Type": "multipart/form-data",
                    },
                  }
                )
                .then((res) => {
                  console.log(res);
                })
                .catch((err) => {
                  console.log(err);
                });
            }
          } else {


         
            const url = "http://127.0.0.1:8000/api/formulario";
            let pregunta = element.name;
            let pregunta_id = pregunta.substr(5, 4);

            axios
              .post(
                url,
                {
                  persona_id: this.selected_participantes,
                  temario_id: pregunta_id,
                  opciones_id: 6 , //id respuesta libre
                  formulario_detalle_id: frm_id, // id formularios
                  respuesta_libr: element.value
                },
                {
                  headers: {
                    "Content-Type": "multipart/form-data",
                  },
                }
              )
              .then((res) => {
                console.log(res);
              })
              .catch((err) => {
                console.log(err);
              });
          }
        });
      });
    this.getParticipantes();
  },

  data() {
    return {
      formDatos: [],
      options: [],
      selected_participantes: null,
      tableItems: this.value,
      perPage: 6,
      currentPage: 1,
      file: null,
      showBtnRows: false,
      text_: "text_",
    };
  },
  methods: {
    inputHandler(value, index, key) {
      this.tableItems[index][key] = value;
      this.$set(this.tableItems, index, this.tableItems[index]);
      this.$emit("input", this.tableItems);
    },
    editRowHandler(data) {
      this.tableItems[data.index].isEdit = !this.tableItems[data.index].isEdit;
    },
    addRowHandler() {
      const newRow = this.fields.reduce(
        (a, c) => ({ ...a, [c.key]: null }),
        {}
      );
      newRow.isEdit = true;
      // this.tableItems.unshift(newRow);
      this.tableItems.push(newRow);
      this.$emit("input", this.tableItems);
    },
    EventUpload() {
      let formData = new FormData();
      formData.append("file", this.file);
      // console.log(formData);
      axios
        .post("http://127.0.0.1:8000/api/ImportExcelPersonas", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            Accept: "application/json, text/plain, */*",
            "Access-Control-Allow-Origin": "*",
          },
        })
        .then(function () {
          console.log("SUCCESS!!");
        })
        .catch(function () {
          console.log("FAILURE!!");
        });
    },
    removeRowHandler(index) {
      this.tableItems = this.tableItems.filter((item, i) => i !== index);
      this.$emit("input", this.tableItems);
    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
    },
    selectRowHandler(data) {
      this.showBtnRows = true;
      this.tableItems[data.index].isSelected =
        !this.tableItems[data.index].isSelected;
    },
    removeRowsHandler() {
      const newItem = this.tableItems.filter((item) => item.isSelected);
      console.log(newItem);
      this.tableItems = this.tableItems.filter((item) => !item.isSelected);

      // this.tableItems = this.tableItems.map((item) => item.isSelected == true);
      this.tableItems.forEach((e) => {
        e.isSelected = false;
      });
      this.$emit("input", this.tableItems);
      this.showBtnRows = false;

      console.log(this.tableItems);
    },
    showRowsHandler(data) {
      this.formDatos = [];
      let form_id = data.item.id;
      this.getQuestion(form_id);
      let title_form = document.getElementById("title");
      let fecha = document.getElementById("fecha");

      title_form.innerHTML = "Formulario " + data.item.nombre_formulario;
      fecha.innerHTML = data.item.fecha;
    },
    getQuestion(id) {
      const url = "http://127.0.0.1:8000/api/formulario_pregunta/" + id;
      const optionsRequest = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };

      axios
        .get(url, optionsRequest)
        .then((response) => {
          this.formDatos.push(response.data);
          // console.log(this.formDatos);
        })
        .catch(console.log)
        .finally(console.log);
    },
    getParticipantes() {
      const url = "http://127.0.0.1:8000/api/persona";
      const optionsRequest = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };
      axios
        .get(url, optionsRequest)
        .then((response) => {
          console.log(response.data);
          response.data.map((item) =>
            this.options.push({ value: item.id, text: item.nombre })
          );
        })
        .catch(console.log)
        .finally(console.log);
    },
    guardarRespuestas() {
      console.log("ok enviados!!");
    },
  },
  computed: {
    rows() {
      return this.tableItems.length;
    },
  },
};
</script>
<style>
#table-content {
  text-align: center;
  margin: 60px;
}

thead,
tbody,
tfoot,
tr,
td,
th {
  text-align: left;
  width: 100px;
  vertical-align: middle;
}

pre {
  text-align: left;
  color: #d63384;
}
</style>
