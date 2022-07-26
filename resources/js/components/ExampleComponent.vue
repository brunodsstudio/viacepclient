<template>
    <div class="container">

      <div class="row g-12"><img  :src="linkbase" class="img-fluid" alt="" /></div>  <br>
<div class="card">
    <div class="card-body">
    <h5 class="card-title">Busca CEP -  ViaCEP</h5>
        <form class="">
            <div class="row g-12">
                <div class="col-auto">
                    <input type="text" v-mask="'#####-###'" class="form-control" id="cep" v-model="cep"  @keyup="buscaCepAPILaravel" placeholder="Digite o CEP">
                </div>
                <br>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mb-4" @click="buscaCepAPILaravel">Buscar</button>
                    
                </div>
            </div>
            <div class="row g-12">
                <div class="col-auto">
                    <label for="cep" class="form-label">Logradouro</label>
                    <input type="text" readonly class="form-control col-sm-4"  v-model="info.logradouro" placeholder="" name="">
                </div>

                <div class="col-auto">
                    <label for="cep" class="form-label">Complemento</label>
                    <input type="text" readonly class="form-control col-sm-4"  v-model="info.complemento" placeholder="" name="">
                </div>

                 <div class="col-auto">
                    <label for="cep" class="form-label">Bairro</label>
                    <input type="text" readonly class="form-control col-sm-4"  v-model="info.bairro" placeholder="" name="">
                </div>

                <div class="col-auto">
                    <label for="cep" class="form-label">Localidade</label>
                    <input type="text" readonly class="form-control col-sm-4"  v-model="fullName" placeholder="" name="">
                </div>

                
            </div>
        </form>
</div></div>

<table class="table">
  <thead>

    <tr>
        <th scope="col">Cep</th>
        <th scope="col">Logradouro</th>   
        <th scope="col">Complemento</th>
        <th scope="col">Bairro</th>    
        <th scope="col">Localidade</th> 
        <th scope="col">Delete</th> 

    </tr>
  </thead>
 <tbody>
    <tr v-for="a in buscas" :key="a.id">
        <td scope="row">{{a.cep}}</td>
        <td>{{a.logradouro}}</td>
        <td>{{a.complemento}}</td>
        <td>{{a.bairro}}</td>
        <td>{{a.localidade}}</td>
        <td><a href="javascript:void(0)" @click="deletaItemTabela(a.id)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr> 
  </tbody>
</table>

    </div>
</template>

<script>

    export default {
        data () {
            return {
                info: {
                    cep: "",
                    logradouro: "",
                    complemento: "",
                    bairro: "",
                    localidade: "",
                    uf: "",
                    ibge: "",
                    gia: "",
                    ddd: "",
                    siafi: ""
                },
                buscas:[],
                linkbase: window.location.href + "images/header.jpg",
                cep:null
                }
                /**/
        },

        methods: {
            buscaCepAPILaravel: function (event) {
                if(this.cep.length == 9) {
                    var vm = this;
                    axios
                    .post(window.location.href+'api/cep', { 
                        cep: this.cep.replace("-", ""), 
                    })
                    .then(response => {
                        this.info = response.data

                        axios
                        .put(window.location.href+'api/insertbusca', { 
                            cep: response.data.cep,
                            logradouro: response.data.logradouro,
                            complemento: response.data.complemento,
                            bairro: response.data.bairro,
                            localidade: response.data.localidade
                        })
                        .then(response => {
                           this.preencheTabela();
                           
                          
      
                        }) 

                    }) 
                }
            }, 
            preencheTabela: function () {
                        
                axios
                    .post(window.location.href+'api/buscas')
                    .then(response => {
                        this.buscas = response.data
                         /*$('#myTable').DataTable({
                            "ajax": JSON.stringify(response.data)
                        });*/
                    }) 
            },
            deletaItemTabela: function(idEsclusao) {

                axios
                    .delete(window.location.href+'api/deletaBusca',{data: {id: idEsclusao}}, {headers:""})
                    .then(response => {
                        this.preencheTabela();
                        //this.buscas = response.data
                         /*$('#myTable').DataTable({
                            "ajax": JSON.stringify(response.data)
                        });*/
                    }) 
            }
            
        },
        mounted() {
        
        },
        computed: {
            fullName: {
            get() {
                return `${this.info.localidade} - ${this.info.uf}`;
            },
            /*set(newValue) {
                const m = newValue.match(/(\S*)\s+(.*)/);

                this.firstName = m[1];
                this.lastName = m[2];
            }*/
            },
            update: function() {
            return this.preencheTabela();
            }
      
            

  }

    }
</script>
<style scoped>

</style>
