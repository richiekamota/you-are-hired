<template>
<div class="row justify-content-center">
    <div class="col-auto">
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Candidates</h2></div>
                    </div>
                </div>
                <table class="table table-bordered" style="border-collapse:collapse; table-layout:fixed; width:1000px; word-wrap:break-word;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>Strengths</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(candidate, index) in this.candidates" :key="index">
                            <td>{{candidate.name}}</td>
                            <td>{{candidate.email}}</td>
                            <td>{{candidate.description}}</td>
                            <td>{{candidate.strengths}}</td>
                            <td>
                                <a class="btn btn-info" title="Contact" data-toggle="tooltip">Contact</a>
                                <a class="btn btn-warning" title="Hire" data-toggle="tooltip">Hire</a>
                            </td>
                        </tr>
                    </tbody>   
                </table>
            </div>
        </div>     
    </div>  
    </div>     
    </div>  
</template>
<script>
    export default {
        props: ['candidates'],
        mounted() {
            console.log(this.candidates)
        }
    }
</script>
