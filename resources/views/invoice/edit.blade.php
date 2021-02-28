@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row justify-content-center" id="invoice" >

            <div class="col-md-8" >
                <div class="card" >
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                {{--                                @{{ invoice.invoice_name }}--}}
                                <input type="text" v-if="moode" v-model="invoice.invoice_name" class="form-control"
                                       placeholder="Invoice Name">
                                <div v-else><span>@{{ invoice.invoice_name }}</span></div>
                                <br>
                                <input type="text" v-if="moode" v-model="invoice.invoice_number" class="form-control"
                                       placeholder="Invoice Number">
                                <div v-else><span>@{{ invoice.invoice_number }}</span></div>
                            </div>
                            <div class="col-sm-6">
                                <input type="date" v-if="moode" v-model="invoice.date" class="form-control"
                                       placeholder="Invoice Date">

                                <div v-else><span>@{{ invoice.date }}</span></div>
                                <br>
                                <select v-if="moode" v-model="invoice.user_id" class="form-control" id="">
                                    <option v-for="user in users" v-if="user.id == invoice.user_id" :value="user.id">@{{
                                        user.name }}
                                    </option>
                                    <option v-for="user in users" v-if="user.id != invoice.user_id" :value="user.id">@{{
                                        user.name }}
                                    </option>
                                </select>
                                <div v-else><span>@{{ invoice.user_id }}</span></div>
                            </div>

                        </div>
                        <br>
                        <div class="col text-center">
                            <button v-if="moode" @click.prevent="Switch(invoice)" class="btn btn-success btn-sm">Save
                            </button>
                            <button v-else @click.prevent="Switch()" class="btn btn-dark btn-sm">Cancel</button>
                        </div>
                        <br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">qty</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody v-if="items">
                            <tr v-for="( item ,index) in items" :key="item.id">

                                <td>
                                    <span> @{{ index+1 }}</span>
                                </td>

                                <td>
                                    <span>@{{ item.name }}</span>
                                </td>


                                <td>
                                    <span>@{{ item.details ?item.details.price :'Empty'}}</span>
                                </td>

                                <td>
                                    <span>@{{ item.details ?item.details.qty:'Empty'}}</span>
                                </td>
                                <td>
                                    <button @click="deleteProfile(item)" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card" >
                    <div class="card-header">{{ __('Dashboard') }}</div>


                    <div class="card-body">
                        <div class="row justify-content-center" >

                            <div class="alert alert-danger" v-if="errors.length > 0">
                                <ul>
                                    <li v-for="error in errors">@{{error}}</li>
                                </ul>
                            </div>
                            <input type="hidden" name="item_id" v-model="detail.item_id">
                            <div class="form-group">
                                <input type="text" name="name" v-model="detail.item.name"  class="form-control" placeholder="Item Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="price" v-model="detail.price"  class="form-control" placeholder="Item Price">
                            </div>
                            <div class="form-group">
                                <input type="text" name="qty" v-model="detail.qty"  class="form-control" placeholder="Item Quantity">
                            </div>


                        </div>
                        <div class="text-center">
                            <button  @click.prevent="Create()" class="btn btn-warning btn-sm">Add</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="modal" id="create-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <button type="button" @click="UpdateCart">Add Cart</button>
                    <button type="button" @click="CreateCart">sa Cart</button>
                </div>
                <div class="modal-footer">
                    <!--                        <button type="button"  @click="UpdateCart"  class="btn btn-primary">update</button>-->
                    <!--                        <button type="button" @click="CreateModal"  class="btn btn-primary">create</button>-->
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                </div>
            </div>
        </div>
    </div>
@STOP
<script>
    alert('done')
</script>
@push('script')
    <script>


            window.items = {!!json_encode($items??[])!!}
            window.invoice = {!!json_encode($invoice??[])!!}
            window.users = {!!json_encode($users??[])!!}
            window.item = {!!json_encode($item??[])!!}


        new Vue({
            el: "#invoice",
            data: {

                invoice: {
                    id: '',
                    invoice_name: '',
                    invoice_number: '',
                    user_id: '',
                },
                errors:[],
                details:[],
                detail:{
                    price:"",
                    qty:"",
                    item_id:"",
                    item:{
                        name:"",
                    }
                },


                moode: true,
                items: items,
                invoice: invoice,
                users: users,
                item: item,
                uri_delete:'http://localhost:8000/product/delete/',
                url_create:'http://localhost:8000/product/create',
                url: 'http://localhost:8000/invoice/'
            }, methods: {

                Switch: function (invoice) {
                    this.moode = this.moode === false ? true : false,
                        this.invoice = invoice
                    console.log(this.url + invoice.id)
                    console.log(this.invoice.user_id)
                    axios.put(this.url + invoice.id, {
                        invoice_name: this.invoice.invoice_name, invoice_number: this.invoice.invoice_number,
                        user_id: this.invoice.user_id, item_id: this.invoice.id, date: this.invoice.date
                    }).then(response => {
                        console.log(response.data);
                    })
                },
                    Create: function () {
                    console.log(invoice.id)
                        axios.post(this.url_create,{
                            price:this.detail.price , name:this.detail.item.name ,qty:this.detail.qty,itemId:invoice.id

                        }).then(response=>{
                            this.items.push(response.data);
                            this.details.push(response.data);

                        })
                            .catch(error => {
                                this.errors = [];
                            if (error.response.data.errors.price){
                                this.errors.push(error.response.data.errors.price[0])
                            }

                        });
                    },
                    deleteProfile(item){
                        this.item = item
                        console.log(this.uri_delete + this.item.id)
                        axios.delete(this.uri_delete + this.item.id ).then(response=>{
                            this.items = response.data.detail.item;
                        });

                    },

            }

        })
    </script>
@endpush
