<nav id="topNav" class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" area-expanded="false" aria-label="Toggle Navigation">
        <span class="oi oi-menu" title="MENU" aria-hidden="true"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-content">  
        <ul class="navbar-nav">

            {%- set menus = [
                  'About': 'about'
                ] -%}
            <li>{{ link_to(null, 'class': 'nav-link', 'Home')}}</li>
            {%- for key, value in menus %}
            {% if value == dispatcher.getControllerName() %}
                {% else %}
                <li>{{ link_to(value, key, 'class':'nav-link') }}</li>
                {% endif %}
                {%- endfor -%}
        </ul>
    </div>
    
<!--     {{ link_to(null, 'class': 'navbar-brand', 'WHT')}} -->
    
    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#nav-content-secondary" aria-controls="nav-content-secondary" area-expanded="false" aria-label="Toggle Navigation Secondary" >
        <span class="oi oi-person" title="person" aria-hidden="true"></span>
    </button>
        <div class="collapse navbar-collapse justify-content-end" id="nav-content-secondary">
            <ul class="navbar-nav">
            {%- if logged_in is defined and not(logged_in is empty) -%}
                <li class="nav-item">{{ link_to('users', 'Admins Panel', 'class':'nav-link') }}</li>
                <li class="nav-item">{{ link_to('session/logout', 'Logout', 'class':'nav-link') }}</li>
            {% else %}
                <li class="nav-item">{{ link_to('session/login', 'Login', 'class':'nav-link') }}</li>
            {% endif %}
            </ul>
        </div>
 </nav>

<main role="main" class="container mt-4">
            {{ content() }}
</main>
{# our common footer #}
<!-- {% include 'partials/footer.volt' %} -->
