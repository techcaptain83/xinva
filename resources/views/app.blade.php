<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="/image/favicon-32x32.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/core.css" />
    <link rel="stylesheet" href="/css/demo.css" />
    <link rel="stylesheet" href="/css/scrollbar.css" />
    <link rel="stylesheet" href="/css/theme.css" />
    <link rel="stylesheet" href="/css/typeahead.css" />
    <link rel="stylesheet" href="/css/waves.css" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" /> -->
    <link href="/css/flowbite.css" rel="stylesheet" />

    {{-- <script>(function(w,r){w._rwq=r;w[r]=w[r]||function(){(w[r].q=w[r].q||[]).push(arguments)}})(window,'rewardful');</script>
    <script async src='https://r.wdfl.co/rw.js' data-rewardful='a04619'></script> --}}
    <!-- Scripts -->

    <script>(function(w){w.fpr=w.fpr||function(){w.fpr.q = w.fpr.q||[];w.fpr.q[arguments[0]=='set'?'unshift':'push'](arguments);};})(window);
        fpr("init", {cid:"1hu4jvos"});
        fpr("click");
    </script>
    <script src="https://cdn.firstpromoter.com/fpr.js" async></script>

    <script>
        window.env = {
            APP_ENV: '{{ env('APP_ENV') }}'
        };
    </script>
    @routes
    @vite(['resources/js/app.js', 'resources/css/app.css', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <!--Script-->
    <script src="/js/stripe.js"></script>
    <script src="https://kit.fontawesome.com/1d433b36eb.js" crossorigin="anonymous"></script>

    @isset($adSenseScript)
        {!! $adSenseScript !!}
    @endisset
    <!-- <script >src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script> -->



</head>

<body class="font-sans antialiased">
    @inertia
</body>

{{-- <script src="https://script.tapfiliate.com/tapfiliate.js" type="text/javascript" async></script>
<script type="text/javascript">
    (function(t,a,p){t.TapfiliateObject=a;t[a]=t[a]||function(){
    (t[a].q=t[a].q||[]).push(arguments)}})(window,'tap');

    tap('create', '42250-0c1617', { integration: "paddle" });
    tap('detect');

    function trackConversion(data) {
        var order_amount = (data.order.total - data.order.total_tax).toFixed(2);
        tap('conversion', data.checkout.checkout_id, order_amount );
    }
</script> --}}

</html>
