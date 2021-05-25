{{ content() }}

<div class="jumbotron" id="overview">
    <div class="container-fluid">
        <h2 class="display-3" align="center">Welcome!</h2>
        <p class="lead" align="center">This is a website where you can track your working hours</p>
        <br>
        <div align="center">
        {%- if logged_in is empty -%}
            {{ link_to(
                    'session/login',
                    '<span class="oi oi-check" aria-hidden="true"></span> Go to my workspace',
                    'class': 'btn btn-info btn-lg'
                )
            }}
        {% else %}
            {{ link_to(
                    'tracker',
                    '<span class="oi oi-clock" aria-hidden="true" ></span> Enter Time Tracker',
                    'class': 'btn btn-info btn-lg'
                )
            }}
        {% endif %}
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-4 mb-3">
            <h3>Developer Info</h3>
            <address>
                <strong>Timur Osmonov</strong><br>
                <a href="mailto:#">osm10ov@gmail.com</a>
            </address>
        </div>
    </div>
    <br>
    <br>
</div>