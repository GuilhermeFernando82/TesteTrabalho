<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastro de Vacinas</div>
                        <div v-if="msg === true">
                            <div class="alert alert-success" role="alert">
                                Cadastrado com Sucesso!
                            </div>
                        </div>
                        <div v-if="error === true">
                            <div class="alert alert-danger" role="alert">
                                Falha ao cadastrar
                            </div>
                        </div>
                        <div v-if="msgUpdate === true">
                            <div class="alert alert-success" role="alert">
                                Alterado com Sucesso!
                            </div>
                        </div>
                    <div class="card-body">
                       <h3 class="text-center">Cadastro de Vacinas</h3><br/>
                         <form @submit.prevent="addBook">
                            <div class="form-group">
                                <label for="exampleFabricante">Fabricante</label>
                                <input type="text" name="fabricante" v-model="book.fabricante" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fabricante">
                                <small class="form-text text-muted">Fabricante da Vacina</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleLote">Lote</label>
                                <input type="text" name="lotes" v-model="book.lotes"  class="form-control" id="exampleInputPassword1" placeholder="Lote">
                            </div>
                            <div class="form-group">
                                <label for="exampleFabricante">Data de Validade</label>
                                <input type="date" name="datadeValidade" v-model="book.datadeValidade" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome completo">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputNumber">Numero de Doses</label>
                                <input type="text" name="numerosdeDoses"  v-model="book.numerosdeDoses" class="form-control" id="exampleInputPassword1" placeholder="Numero de Doses">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Intervalo minimo entre doses</label>
                                <input type="text" name="intervaloDoses" v-model="book.intervaloDoses" class="form-control" id="exampleInputPassword1" placeholder="Entre com tempo minimo entre doses">
                            </div>
                             <button type="submit" class="btn btn-success mt-3 mb-3">Cadastrar</button>
                         </form>
                         <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Fabricante</th>
                                            <th scope="col">Lote</th> 
                                            <th scope="col">Data Validade</th> 
                                            <th scope="col">Numero de Doses</th>
                                            <th scope="col">Intervalo Minimo</th>
                                            <th scope="col">Alterar</th>
                                            <th scope="col">Excluir</th>        
                                        </tr>
                                    </thead>
                                    <tbody>          
                                            <tr  v-for="post in post" :key="post.id">  
                                            <td>{{ post.id }}</td>          
                                            <td> <input type="text" name="post.fabricante" v-model="post.fabricante"></td>
                                            <!--<td>{{ post.name }}</td>-->
                                            <td> <input type="text" name="post.lotes" v-model="post.lotes"></td>
                                            <td> <input type="text" name="post.datadeValidade" v-model="post.datadeValidade"></td>
                                            <td> <input type="text" name="post.numerosdeDoses" v-model="post.numerosdeDoses"></td>
                                            <td> <input type="text" name="post.intervaloDoses" v-model="post.intervaloDoses"></td>
                                            <td><button class="btn btn-secondary" @click="updateName(post.id,post.fabricante,post.lotes,post.datadeValidade,post.numerosdeDoses,post.intervaloDoses)">Alterar</button></td>
                                            <td><button class="btn btn-danger" @click="removeName(post.id)">Excluir</button></td>
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
                book: {},
                post: [],
                msgUpdate: false,

        }
        },
        created() {
            this.axios
                    .get('http://localhost:8000/api/vacina')
                    //.then(response => console.log(response.data))
                    .then(response => (this.post = response.data))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
        },
        
        methods: {
            addBook() {
                var axios = require('axios');
                var data = JSON.stringify({"fabricante":this.book.fabricante,"lotes":this.book.lotes,"datadeValidade":this.book.datadeValidade,"numerosdeDoses":this.book.numerosdeDoses,"intervaloDoses":this.book.intervaloDoses});

                var config = {
                method: 'post',
                url: 'http://localhost:8000/api/addVacina',
                headers: { 
                    'Content-Type': 'application/json'
                },
                data : data
                };

                axios(config)
                .then((response) => {
                if(JSON.stringify(response.data) === '1'){
                     this.error = true;
                }else{
                     this.msg = true;   
                }})
                .catch(function (error) {
                console.log(error);
                });

              

                
                
            },
            removeName(id){
                 this.axios
                    .delete(`http://localhost:8000/api/vacina/${id}`)
                    .then(console.log("Removido com sucesso!!!"))
                    .catch(error => console.log(error))
                    .finally(window.location.href = 'http://localhost:8000')
                 
            },
            updateName(id,fabricante,lotes,datadeValidade,numerosdeDoses,intervaloDoses){
                var axios = require('axios');
                var data = JSON.stringify({"fabricante":fabricante,"lotes":lotes,"datadeValidade":datadeValidade,"numerosdeDoses":numerosdeDoses,"intervaloDoses":intervaloDoses});

                var config = {
                method: 'put',
                url: `http://localhost:8000/api/vacina/${id}`,
                headers: { 
                    'Content-Type': 'application/json'
                },
                data : data
                };

                axios(config)
                .then(function (response) {
                console.log(JSON.stringify(response.data));
                })
                .then(this.msgUpdate = true)
                .catch(function (error) {
                console.log(error);
                });

            
            }
        }
     }
    
    
</script>
