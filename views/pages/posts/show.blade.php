<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
    $ip = $_SERVER['REMOTE_ADDR'];
}

$db = new mysqli("127.0.0.1","root","root","myblog");

$query = $db->query("SELECT `ip` from `users_ip` where `ip` = '$ip'")->fetch_array();
//$viewed_post_id = $db->query("SELECT `viewed_post_id` from `users_ip` where `ip` = '$ip'")->fetch_array();

$stmt = $db->prepare("SELECT `viewed_post_id` from `users_ip` where `ip` = '$ip'");
$stmt->execute();
$viewed_post_id = [];
foreach ($stmt->get_result() as $row)
{
    $viewed_post_id[] = $row['viewed_post_id'];
}

if(!isset($query['ip'])){

    $db->query("UPDATE posts SET views = views + 1 WHERE id = $post->id");
    $db->query("INSERT INTO users_ip (ip,viewed_post_id) VALUES ('$ip','$post->id')");

}else if(isset($query['ip']) && !in_array($post->id,$viewed_post_id)){
    $db->query("UPDATE posts SET views = views + 1 WHERE id = $post->id");
    $db->query("INSERT INTO users_ip (ip,viewed_post_id) VALUES ('$ip','$post->id')");
}

?>
<x-layouts.app :title="$post->name">

    <h1>{{ $post->name }}</h1>

    <a href="{{ route('posts.index') }}" class="btn mb-2 btn-primary">
        {{ __('All Posts') }}
    </a>

    <div>
        <span class="views">Views: {{ $post->views }}</span>
    </div>

    <div class="card my-3">
        <div class="card-header">
            {{ __('Tag') }}
        </div>

        <div class="card-body">
            @if($post->tag)
                <b>Post tag:</b> #{{ $post->tag->name }}
            @else
                {{ __('Without tag') }}
            @endif
        </div>
    </div>

    @if($post->image_path)
        <div class="card my-3">
            <div class="card-header">
                <img height="250" src="{{ \Storage::url($post->image_path) }}" alt="">
            </div>
        </div>
    @endif

    @if($description = trim($post->description))
        <div class="card my-3">
            <div class="card-header">
                {{ __('Description') }}
            </div>
            <div class="card-body">
                {{ $description }}
            </div>
        </div>
    @endif

    <br>

    <!-- Put this div tag to the place, where the Comments block will be -->
    <div id="vk_comments"></div>
    <script type="text/javascript">
        VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
    </script>

</x-layouts.app>
