<template>
		<div
			class="modal fade"
			id="parcipant-modal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="parcipant-modal"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="">
						<form method="post" @submit.prevent="submit">
							<div class="modal-header">
								<h5 class="modal-title vue-color">{{ modalTitle }}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true"><img :src="'/assets/dismiss.svg'"></span>
								</button>
							</div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              	<button type="submit" id="submit-btn" class="btn bg-orange color-white">Agregar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
		props: ['showParticipantForm'],
    data(){
			return{
				modalTitle: ''
			}
		},
		methods: {
			submit(){

			}
		}
}
</script>