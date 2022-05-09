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
                                <tr v-for="(candidate, i) in this.candidates" :key="i">
                                    <td>{{candidate.name}}</td>
                                    <td>{{candidate.email}}</td>
                                    <td>{{candidate.description}}</td>
                                    <td>{{candidate.strengths}}</td>
                                    <td>                                   
                                        <button class="btn btn-info" v-on:click="postContactCandidate(candidate.id,companyId)" :disabled="candidate.status !== 'Waiting'">Contact</button>
                                        <button class="btn btn-warning" v-on:click="postHireCandidate(candidate.id,companyId)" :disabled="candidate.status == 'Waiting' && candidate.status !== 'Contacted' || candidate.status == 'Hired'">Hire</button>                                                                               
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
        props: ['candidates','company_id'],
        mounted() {
            console.log(this.candidates,parseInt(this.company_id))
        },
        data () {
            return {
              companyId: parseInt(this.company_id)
            }
            
            },
        methods: {

            postContactCandidate: function(candidateid,companyid){
                axios.post('/candidates-contact/'+ candidateid + '/' + companyid)
                .then((response) => {
                  console.log('Candidate Contacted!')
                  window.location.reload();
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
             postHireCandidate: function(candidateId,companyId){
                axios.post('/candidates-hire/'+ candidateId + '/' + companyId)
                .then((response) => {
                    console.log('Candidate Hired!')
                    window.location.reload();
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        }    


    }
</script>
