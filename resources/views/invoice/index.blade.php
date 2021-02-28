@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="invoice">
                    <div class="card-header">{{ __('Dashboard') }}
                        <button v-if="moode" @click.prevent="Switch()" class="btn btn-primary btn-sm">Save</button>
                        <button v-else @click.prevent="Switch()" class="btn btn-dark btn-sm">UnSave</button>
                    </div>


                    <div class="card-body" v-for="invoice in invoices" :key="invoice.id">
                        @{{ invoice.user_id.name2 }}
                        <span v-if="moode">@{{ invoice.name }}</span>
                        <input v-else type="text" v-model="invoice.name" name="name" class="form-control" placeholder="Invoice Name">
                        <span v-if="moode">@{{ invoice.date }}</span>
                        <input type="date" name="name" v-model="invoice.date" class="form-control" placeholder="Date">
                        <span v-if="moode"></span>
                        <input type="text" name="name" class="form-control" placeholder="Invoice Number">
                        <input type="text" name="name" class="form-control" placeholder="Invoice Account">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @STOP
@push('script')
    <script>
        window.invoices = {!!json_encode($invoices??[])!!}
new Vue({
el:"#invoice",
    data:{
        moode:true,
        invoices:invoices,
        url:'http://localhost:8000/invoice'
    },methods:{
        Switch:function (){
            // alert('done')
            this.moode = this.moode === false ? true :false
        },

    },

})
    </script>
    @endpush
