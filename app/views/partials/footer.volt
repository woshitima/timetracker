{# this is example of "include" in volt which we are using for our common footer everywhere #}

<footer class="topFooter container-fluid">
    <div class="row">
            <div class="col-md-4">
                {{ date("Y/m/d H:i") }}
            </div>
            <div class="col-md-4">
                {{ link_to("privacy", "Privacy Policy") }}
                {{ link_to("terms", "Terms") }}
            </div>
            <div class="col-md-4">
                 &copy; Timur Osmonov.
            </div>
    </div>
</footer>
            