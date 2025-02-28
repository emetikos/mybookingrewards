<div x-data="datepicker(@entangle('dates'),
    {
        mode: 'range',
        dateFormat: 'd M Y',
    }
)">
    <div class="flex flex-col">
        <div class="flex items-center gap-2">
            <input  class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900"
                x-ref="myDatepicker"
                x-model="value"
                wire:model.live="dates"
                type="text">
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('datepicker', (model, config) => ({
            value: model,
            init(){
                this.pickr = flatpickr(this.$refs.myDatepicker, config)
                this.$watch('value', function(newValue){
                    this.pickr.setDate(newValue);
                }.bind(this));
            }
        }))
    })
</script>
