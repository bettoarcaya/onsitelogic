<template>
  <div>
    <div
			class="modal fade"
			id="data-modal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="data-modal"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="">
						<div class="modal-header bg-orange">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><img :src="'/assets/dismiss.svg'"></span>
							</button>
						</div>
						<div class="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" id="edit-btn" class="btn bg-orange color-white">Editar</button>
						</div>
					</div>
				</div>
			</div>
    </div>
  </div>
</template>

<script>
export default {
	props: ['participantId'],
	data(){
		return{

		}	
	},
	methods: {
		
	}
}
</script>