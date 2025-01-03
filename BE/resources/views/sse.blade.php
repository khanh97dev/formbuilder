@php $uuid = Str::uuid() @endphp
<style>
    body {
        width: 400px;
        margin: auto;
    }
    ul {
        display: flex;
        flex-direction: column;
        list-style: none;
    }
    li {
        justify-items: flex-end;
    }
    .me {
        justify-items: flex-start;
    }
</style>
<ul></ul>
<input type="text" />

<script>
    var $source = new EventSource("/sse/" + "{{ $uuid }}");
    var $data = [];
    $source.onmessage = function (event) {
        console.log(event.data);
        const response = JSON.parse(event.data);
        const hasData =
            response && $data.find((i) => i.timestamp == response.timestamp);
        if (!hasData) {
            $data.push(response);
            const ul = document.querySelector("ul");
            const li = document.createElement("li");
            const strong = document.createElement("strong");
            const p = document.createElement("p");
            if (response.uuid === "{{ $uuid }}") {
                li.classList.add("me");
            }
            strong.textContent = "UUID: " + response.uuid;
            p.textContent = response.text;
            li.appendChild(strong);
            li.appendChild(p);
            ul.appendChild(li);
        }
    };
    document
        .querySelector("input")
        .addEventListener("keypress", function (event) {
            const enter = event.keyCode === 13;
            if (enter) {
                fetch("/sse", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        uuid: "{{ $uuid }}",
                        text: this.value,
                        timestamp: Date.now(),
                    }),
                });
                alert("sent");
                this.value = "";
            }
        });
</script>
