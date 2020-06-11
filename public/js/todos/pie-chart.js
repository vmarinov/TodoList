//pie
let numberOfLists = task_data.length;

if (numberOfLists) {
    for (let index = 0; index < numberOfLists; index++) {
        var ctxP = document.getElementById("pieChart" + index).getContext("2d");

        let chart = new Chart(ctxP, {
            type: "pie",
            data: {
                labels: ["Completed", "Active", "Disabled", "Expired"],
                datasets: [
                    {
                        data: [
                            task_data[index]["completed"],
                            task_data[index]["active"],
                            task_data[index]["disabled"],
                            task_data[index]["expired"]
                        ],
                        backgroundColor: [
                            "#46BFBD",
                            "#FDB45C",
                            "#4D5360",
                            "#F7464A"
                        ],
                        hoverBackgroundColor: [
                            "#5AD3D1",
                            "#FFC870",
                            "#616774",
                            "#FF5A5E"
                        ]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    }
}
