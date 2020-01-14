<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange color-white">
                    <h4 class="float-left">Lista de asistentes</h4>
                    <a
                        class="btn btn-light float-right"
                        href="javascript:void(0)">
                        Agregar
                    </a>
                </div>
                <div class="card-body">
                  <div v-if="participantList.length == 0">
										<h5 class="color-orange"> No se encontraron participantes </h5>
									</div>
									<div v-else>
										<table class="table table-hover table-striped">
											<thead>
												<tr class="vue-color">
													<th>Nombre</th>
													<th>Apellido</th>
													<th>Email</th>
													<th colspan="2">
													</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="participant in participantList" :key="participant.id">
													<td>{{participant.name}}</td>
													<td>{{participant.lastname}}</td>
													<td>{{participant.email}}</td>
													<!--<td width="10px">
														<a
															href="javascript:void(0)"
															class="btn btn-sm"
															data-toggle="modal"
															data-target="#watch-client-modal"
															v-on:click="openModal(client)">
															<img
																class="w-20-px"
																:src="'/assets/icons/eye-solid.svg'">
														</a>
													</td>
													<td width="10px">
														<a
															href="javascript:void(0)"
															class="btn btn-sm"
															data-toggle="modal"
															data-target="#edit-client-modal"
															v-on:click="openEditModal(client)">
															<img
																class="w-20-px"
																:src="'/assets/icons/edit-solid.svg'">
														</a>
													</td>
													<td width="10px">
														<a
															href="javascript:void(0)"
															class="btn btn-sm"
															data-toggle="modal"
															data-target="#delete-client-modal"
															v-on:click="openDeleteModal(client.name, client.id)">
															<img
																class="w-20-px"
																:src="'/assets/icons/trash-alt-solid.svg'">
														</a>
													</td>-->
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
    beforeMount(){

    },
    data(){
			return{
				participantList: [],
				pagInformation: {}
			}
    },
    methods: {

    }
}
</script>