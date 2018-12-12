<template>
    <div>
        <p><strong>Schedule</strong></p>
        <div class="row" v-for="bookday in bookingdays">
            <div class="col-md-3">
                <input id="booking_day" name="booking_day" class="form-control" v-bind:value='bookday.booking_day'/>
            </div>
            <div class="col-md-3">
                <input  id="start" name="time_start" type="text" class="form-control" v-bind:value='bookday.start'/>
            </div>
            <div class="col-md-3">
                <input  id="end" name="end" type="text" class="form-control" v-bind:value='bookday.end'/>
            </div>
        </div>
        <div class="row" v-if="addBookingday">

            <div class="col-md-3">
                <input name="booking_day" type="text" class="form-control" v-model='newBookingday.booking_day'/>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" v-model='newBookingday.start'/>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" v-model='newBookingday.end'/>
            </div>
            <div class="col-md-1">

            </div>
        </div>
        <div class="clearfix">
            <button type="button" class="pull-right btn-primary btn" v-on:click="addForm()">Add</button>
        </div>
    </div>

</template>

<script>

    export default{
        data(){
            return {
                bookingdays: [],
                addBookingday: false,
                newBookingday: {
                    booking_day: '',
                    start: '',
                    end: '',
                    num: '',
                    item_day: 0,
                    last_day: ''
                }
            }
        },
        props: [
            'bdays'
        ],
        created(){
            this.bookingdays = jQuery.parseJSON(this.bdays);
            newBookingday.last_day = this.bookingdays[this.bookingdays.length-1]['booking_day'];
        },
        methods: {
            addForm() {
                if (this.newBookingday.booking_day != '' && this.newBookingday.start != '' &&
                        this.newBookingday.end != '') {
                    this.bookingdays.push({
                        booking_day: this.newBookingday.booking_day,
                        start: this.newBookingday.start,
                        end: this.newBookingday.end
                    });
                    this.newBookingday.item_day++;
                    this.clearForm();
                }
                this.addBookingday = true;
            },
            clearForm() {
                this.newBookingday.booking_day = '';
                this.newBookingday.start = '';
                this.newBookingday.end = '';
            }
        }
    }

</script>