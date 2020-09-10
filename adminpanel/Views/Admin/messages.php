<?php
if (!isset($_SESSION["name"]))
{
    header("Location: /adminpanel/admin/");
}
?>

<div>
    <h1>Időpontok</h1>
    <?php

        echo '<table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Cég neve</th>
                <th scope="col">Cégvezető neve</th>
                <th scope="col">Időpontok</th>
            </tr>
        </thead>
        <tbody>';

        for ($i = 0; $i < count($mainData); $i++)
        {
            $json = json_decode($mainData[$i]["value"], true);
            $dates = "";
            
            foreach ($json["appointment"] as $date)
            {
                $dates .= $date . ", ";
            }

            echo '
            <tr>
                <td>' . $json["basic"]["name"] . '</td>
                <td>' . $json["members"]["member_1"]["fullName"] . '</td>
                <td>' . $dates . '</td>
            </tr>
            ';
        }

        echo "</tbody></table>";
    ?>
</div>

<div style="margin-top: 100px;">
    <h1>Üzenetek</h1>
    <div>
        <button type="button" class="btn btn-primary col-md-6" id="video-chat">Videóhívás indítása</button>
    </div>
</div>

<div style="margin-top: 100px;">
    <h1>Videóhívás felvétel</h1>
    <p id="warning">
        Enable chrome://flags/#enable-experimental-web-platform-features
    </p>
    <video style="width: 640px !important; height: 480px !important;" id="videoElement" autoplay muted></video>
    <br />
    <button class="btn btn-success col-md-6" id="captureBtn">Felvétel indítása</button>
    <button class="btn btn-danger col-md-6" id="stopBtn" disabled>Felvétel megállítása</button>
    <br />
    <input type="checkbox" id="audioToggle" checked disabled>
    <label for="audioToggle">Asztal hangok felvétele</label>
    <input type="checkbox" id="micAudioToggle" checked disabled>
    <label for="micAudioToggle">Mikrofon felvétel</label>
    <a id="download" class="btn btn-danger col-md-6 mx-auto" href="#" style="display: none;">Felvétel letöltés</a>
</div>

<script>
window.onload = () => {
    const warningEl = document.getElementById("warning");
    const videoElement = document.getElementById("videoElement");
    const captureBtn = document.getElementById("captureBtn");
    const stopBtn = document.getElementById("stopBtn");
    const download = document.getElementById("download");
    const audioToggle = document.getElementById("audioToggle");
    const micAudioToggle = document.getElementById("micAudioToggle");
    
    if("getDisplayMedia" in navigator.mediaDevices) warningEl.style.display = "none";
  
    let blobs;
    let blob;
    let rec;
    let stream;
    let voiceStream;
    let desktopStream;
    
    const mergeAudioStreams = (desktopStream, voiceStream) => {
        const context = new AudioContext();
        const destination = context.createMediaStreamDestination();
        let hasDesktop = false;
        let hasVoice = false;
        if (desktopStream && desktopStream.getAudioTracks().length > 0)
        {
            // If you don"t want to share Audio from the desktop it should still work with just the voice.
            const source1 = context.createMediaStreamSource(desktopStream);
            const desktopGain = context.createGain();
            desktopGain.gain.value = 0.7;
            source1.connect(desktopGain).connect(destination);
            hasDesktop = true;
        }
        
        if (voiceStream && voiceStream.getAudioTracks().length > 0)
        {
            const source2 = context.createMediaStreamSource(voiceStream);
            const voiceGain = context.createGain();
            voiceGain.gain.value = 0.7;
            source2.connect(voiceGain).connect(destination);
            hasVoice = true;
        }
            
        return (hasDesktop || hasVoice) ? destination.stream.getAudioTracks() : [];
    };
  
    captureBtn.onclick = async () => {
        download.style.display = "none";
        const audio = audioToggle.checked || false;
        const mic = micAudioToggle.checked || false;
        
        desktopStream = await navigator.mediaDevices.getDisplayMedia({ video: true, audio: audio });
        
        if (mic === true)
        {
            voiceStream = await navigator.mediaDevices.getUserMedia({ video: false, audio: mic });
        }
        
        const tracks = [
            ...desktopStream.getVideoTracks(), 
            ...mergeAudioStreams(desktopStream, voiceStream)
        ];
        
        console.log("Tracks to add to stream", tracks);
        stream = new MediaStream(tracks);
        console.log("Stream", stream)
        videoElement.srcObject = stream;
        videoElement.muted = true;
            
        blobs = [];
        
        rec = new MediaRecorder(stream, {mimeType: "video/webm; codecs=vp9,opus"});
        rec.ondataavailable = (e) => blobs.push(e.data);
        rec.onstop = async () => {
            
            //blobs.push(MediaRecorder.requestData());
            blob = new Blob(blobs, {type: "video/webm"});
            let url = window.URL.createObjectURL(blob);
            download.href = url;
            download.download = "test.webm";
            download.style.display = "block";

            let tracks = videoElement.srcObject.getTracks();

            console.log(tracks);

            tracks.forEach(track => track.stop());
            videoElement.srcObject = null;
            stream = null;
        };
        captureBtn.disabled = true;
        stopBtn.disabled = false;
        rec.start();
    };
  
    stopBtn.onclick = () => {
        captureBtn.disabled = false;
        stopBtn.disabled = true;
        
        rec.stop();
    };
};
</script>