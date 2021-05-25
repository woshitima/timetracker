{{ form('role': 'form', 'autocomplete' : 'off') }}

<div class="row mb-4">
    <div class="col-6">
        {{ link_to("users/search/", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
    </div>
    <div class="col-6 text-right">
        {{ submit_button('Save', "class": "btn btn-big btn-success") }}
    </div>
</div>

{{ content() }}

<div class="row d-flex justify-content-center">
    <div class="col-md-8  mb-4 mt-4">
        <h2 class="mb-sm-6 pb-sm-2">Edit users</h2>
        <div class="tabbable mt-4">
            <div class="tab-content">
                <div class="tab-pane active fade show" role="tabpanel" id="A">

                    {{ form.render("id") }}

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {{ form.label('name') }}
                            {{ form.render('name' , ['class' : 'form-control ']) }}
                        </div>
                        <div class="col-sm-6">
                            {{ form.label('email') }}
                            {{ form.render('email' , ['class' : 'form-control ']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {{ form.label('profilesId') }}
                            {{ form.render('profilesId' , ['class' : 'form-control ']) }}
                        </div>
                        <div class="col-sm-6">
                            {{ form.label('active') }}
                            {{ form.render('active' , ['class' : 'form-control ']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ form.label('password', ['class' : 'col-md-3 col-form-label']) }}
                        <div class="col-md-6">
                                <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>