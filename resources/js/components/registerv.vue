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
                                Já existe um usuário com este email ou CPF 
                            </div>
                        </div>
                        <div v-if="msgUpdate === true">
                            <div class="alert alert-success" role="alert">
                                Alterado com Sucesso!
                            </div>
                        </div>
                    <div class="card-body">
                       <h3 class="text-center">Cadastro de Pacientes</h3><br/>
                         <form @submit.prevent="addBook">
                            <div class="form-group">
                                <label for="exampleFabricante">Nome</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" v-model="book.name" placeholder="Nome completo">
                            </div>
                            <div class="form-group">
                                <label for="exampleLote">CPF</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="CPF" name="cpf" v-model="book.cpf">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputValidad">Data de Nascimento</label>
                                <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Data de Nascimento" name="datadeNascimento" v-model="book.datadeNascimento">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputNumber">Email</label>
                                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="E-mail"  name="email" v-model="book.email">
                            </div>
                             <button type="submit" class="btn btn-success mt-3 mb-3">Cadastrar</button>
                         </form>
                        
                                
                        
                    </div>
                </div>
            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Email</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>          
                <tr  v-for="post in post" :key="post.id">  
                    <td>{{ post.id }}</td>          
                    <td> <input type="text" name="post.name" v-model="post.name"></td>
                                                        <!--<td>{{ post.name }}</td>-->
                    <td> <input type="text" name="post.cpf" v-model="post.cpf"></td>
                    <td> <input type="text" name="post.datadeNascimento" v-model="post.datadeNascimento"></td>
                    <td> <input type="text" name="post.Email" v-model="post.Email"></td>
                    <td><button class="btn btn-secondary" @click="updateName(post.id,post.name,post.cpf,post.datadeNascimento,post.Email)">Alterar</button></td>
                    <td><button class="btn btn-danger" @click="removeName(post.id)">Excluir</button></td>
                </tr>                       
            </tbody>
        </table>
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
                error: false

        }
        },
        created() {
            this.axios
                    .get('http://localhost:8000/api/home')
                    //.then(response => console.log(response.data))
                    .then(response => (this.post = response.data))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
        },
        
        methods: {
            addBook() {
                var axios = require('axios');
                var data = JSON.stringify({"name":this.book.name,"cpf":this.book.cpf,"datadeNascimento":this.book.datadeNascimento,"email":this.book.email});

                var config = {
                method: 'post',
                url: 'http://localhost:8000/api/add',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Cookie': 'XSRF-TOKEN=eyJpdiI6IlA2TnI1MEx2dHZxZVEwVVI0QUtqcVE9PSIsInZhbHVlIjoiMzVpZzg0bmt2S1dQRXpiY255b1FEaXUzTFFaR2VjcTZ4V3VzdmFGN0ROT1dmL3RhMWExNlQ3Qzg3TUU1dUhOYTA2L2dLQkJFSGJsMGVualdYNkdJTFRkYnVhMVVHZXFPUzRRczU2Ni9ubW5BVHlqRWJyT0g3eTk1K0xPNTVKekUiLCJtYWMiOiI3N2I4OGFmMTZhMGI4YzM5NTMyZmJmMTkxZjc2YzI1NjhlMDliMGUxODJiMmQ0NGE3YjQ4MjVjMDk0ZmZjNTU3In0%3D; laravel_session=eyJpdiI6ImlkNm1PUDJPVE9wU3hNUmZTYi9vSWc9PSIsInZhbHVlIjoiUUVpUzdGM3BEK0d0eDM0dlkzWmgyOUN2dG9YQWg5VkYyZHhxSUZZcHZlTEZzMGhIdzZPRktlenVCZ0huM1JLNmEzWTZvQ2UyenFSUkZDREpMQXlHTHBuODZESGI0eHBSajNFbFpKTmFIUVhTdVVXY05UL1hDQUV6S0dPNnNvM0siLCJtYWMiOiJlMTAyODZlNjVhMmMwYjliNGQzMzQyNzcxYjFlNmQ5MzBlZTg3ZjE1YjVmZDRiNzdmM2U1ZDc0ODdmMWViMGRlIn0%3D'
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
                    .delete(`http://localhost:8000/api/home/${id}`)
                    .then(console.log("Removido com sucesso!!!"))
                    .catch(error => console.log(error))
                    .finally(window.location.href = 'http://localhost:8000/pacientes')
                 
            },
            updateName(id,name,cpf,datadeNascimento,email){
                var axios = require('axios');
                var data = JSON.stringify({"name":name,"cpf":cpf,"datadeNascimento":datadeNascimento,"Email":email});

                var config = {
                method: 'put',
                url: `http://localhost:8000/api/home/${id}`,
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
