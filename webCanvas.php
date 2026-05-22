<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>摄像头直播</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/flv.js/1.6.2/flv.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #1a1a2e; display: flex; justify-content: center; align-items: center; min-height: 100vh; font-family: Arial; }
        .container { background: #16213e; border-radius: 16px; padding: 20px; }
        video { width: 800px; height: 600px; background: #000; border-radius: 8px; }
        .info { color: #00d9ff; margin-top: 15px; text-align: center; }
        .status { color: #aaa; font-size: 12px; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <video id="videoElement" controls autoplay muted></video>
        <div class="info">📹 实时监控</div>
        <div class="status" id="status">连接中...</div>
    </div>
    <script>
        var videoElement = document.getElementById('videoElement');
        var statusDiv = document.getElementById('status');
        
        if (flvjs.isSupported()) {
            var flvPlayer = flvjs.createPlayer({
                type: 'flv',
                isLive: true,
                url: 'http://localhost:8000/live/stream.flv'
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();
            
            flvPlayer.on(flvjs.Events.ERROR, function() {
                statusDiv.innerHTML = '❌ 连接失败，请检查推流是否正常';
            });
            
            flvPlayer.on(flvjs.Events.LOADING_COMPLETE, function() {
                statusDiv.innerHTML = '✅ 正在播放';
            });
        } else {
            statusDiv.innerHTML = '❌ 浏览器不支持 flv.js';
        }
    </script>
</body>
</html>