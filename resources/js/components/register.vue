<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastro de Vacinas</div>
                        <div v-if="msg === true">
                            <div class="alert alert-success" role="alert">
                                Sucesso, Paciente acaba de tomar a nova Dose
                            </div>
                        </div>
                        <div v-if="error === true">
                            <div class="alert alert-danger" role="alert">
                                Paciente já tomou vacina!
                            </div>
                        </div>
                         <div v-if="error2 === true">
                            <div class="alert alert-danger" role="alert">
                                Paciente já tomou vacina
                            </div>
                        </div>
                        <div v-if="msgUpdate === true">
                            <div class="alert alert-success" role="alert">
                                Sucesso, tomou a vacina
                            </div>
                        </div>
                    <div class="card-body">
                       <h3 class="text-center">Registro de Vacinação</h3><br/>
                         <form @submit.prevent="addBook">
                            <div class="form-group">
                                <label for="exampleFabricante">Data de Vacinação</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" v-model="book.dataVacinacao" name="dataVacinacao" aria-describedby="emailHelp" placeholder="Nome completo">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputValidad">Identificação da Vacina</label>
                                <label for="sel1">Selecione a Vacina:</label>
                                    <select class="form-control"  name="id_vacina" v-model="book.id_vacina" id="sel1">
                                        <option v-for="postV in postV" :key="postV.id" name="id_vacina" v-model="book.id_vacina">{{ postV.fabricante }}</option>
                                        
                                    </select>
                        
                            </div>
                            <div class="form-group">
                                <label for="exampleLote">CPF de Identificação do Paciente</label>
                                <input type="text" class="form-control" name="cpfId" v-model="book.cpfId" id="exampleInputPassword1" placeholder="CPF de Identificação do Paciente">
                            </div>
                            
                             <div class="form-group">
                                <label for="exampleInputValidad">Identificação da Dose</label>
                                <label for="sel1">Selecione a Dose:</label>
                                    <select class="form-control" name="idDose" value="1° Dose" v-model="book.idDose" id="sel1">
                                        <option name="idDose" value="1° Dose" v-model="book.idDose">1° Dose</option>
                                        <option name="idDose" value="2° Dose" v-model="book.idDose">2° Dose</option>
                                    </select>
                        
                            </div>
                             <button type="submit" class="btn btn-success mt-3 mb-3">Cadastrar</button>
                         </form>
                        <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Vacina</th> 
                                            <th scope="col">Data da Vacinação</th>
                                            <th scope="col">Cpf de Identificação</th> 
                                            <th scope="col">Doses Tomadas</th>   
                                        </tr>
                                    </thead>
                                    <tbody>          
                                        <tr  v-for="postPessoasVacinadas in postPessoasVacinadas" :key="postPessoasVacinadas.id">  
                                            <td>{{ postV.id }}</td>          
                                            <td> <input type="text" name="postPessoasVacinadas.id_vacina" v-model="postPessoasVacinadas.id_vacina"></td>
                                            <!--<td>{{ post.name }}</td>-->
                                            <td> <input type="text" name="postPessoasVacinadas.dataVacinacao" v-model="postPessoasVacinadas.dataVacinacao"></td>
                                            <td> <input type="text" name="postPessoasVacinadas.cpfId" v-model="postPessoasVacinadas.cpfId"></td>
                                            <td> <input type="text" name="postPessoasVacinadas.idDose" v-model="postPessoasVacinadas.idDose"></td>

                                        </tr>                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
     export default {
        data() {
            return {
                
                msg: false,
                error2: false,
                error: false,
                book: {},
                post: [],
                postV: [],
                postPessoasVacinadas: [],
                msgUpdate: false,

        }
        },
        created() {
            this.axios
                    .get('http://localhost:8000/api/home')
                    //.then(response => console.log(response.data))
                    .then(response => (this.post = response.data))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            this.axios
                    .get('http://localhost:8000/api/vacina')
                    //.then(response => console.log(response.data))
                    .then(response => (this.postV = response.data))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            this.axios
                    .get('http://localhost:8000/api/vacinaregistro')
                    //.then(response => console.log(response.data))
                    .then(response => (this.postPessoasVacinadas = response.data))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
        },
        
        methods: {
            addBook() {
                var axios = require('axios');
                //var data = JSON.stringify({"id_vacina":this.book.id_vacina,"dataVacinacao":this.book.dataVacinacao,"cpfId":this.book.cpfId,"idDose":this.book.idDose});
                var data = JSON.stringify({"dataVacinacao":this.book.dataVacinacao,"id_vacina":this.book.id_vacina,"cpfId":this.book.cpfId,"idDose":this.book.idDose});
                var config = {
                method: 'post',
                url: 'http://localhost:8000/api/addRegistroV',
                headers: { 
                    'Content-Type': 'application/json'
                },
                data : data
                };

                axios(config)
                .then((response) => {
                if(JSON.stringify(response.data) === '1'){
                     this.error = true;
                }if(JSON.stringify(response.data) === '2'){
                     this.error2 = true;
                }if(JSON.stringify(response.data) === '3'){
                     this.msg = true;   
                }
                if(JSON.stringify(response.data) === '4'){
                     this.msgUpdate = true;   
                }})
                .catch(function (error) {
                console.log(error);
                });

            },
           
        }
     }
    
    
</script>
