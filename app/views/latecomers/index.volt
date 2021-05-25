{{ content() }}

<div class="row d-flex justify-content-center">
    <div class="col-xl-6  mb-4 mt-4">
        <h2 class="mb-sm-6 pb-sm-2" align="center">Search Latecomers Info</h2>
        {{ form("latecomers/search", 'role': 'form', 'autocomplete' : 'off') }}

       <div class="form-group row">
            {{ form.label('date', ['class' : 'col-md-3 col-form-label']) }}
            <div class="col-md-9">
                {{ form.render('date' , ['class' : 'form-control ']) }}
            </div>
        </div>

        <div class="form-group row justify-content-end">
            <div class="col-md-9" >
                {{ submit_button("Search", "class": "btn btn-info btn-block") }}
            </div>
        </div>
        </form>
    </div>
</div>