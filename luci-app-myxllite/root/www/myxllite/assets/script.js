async function getData() {
  let resultApi = "0";
  await fetch("getData.php")
    .then((response) => response.json())
    .then((json) => (resultApi = json))
    .catch((err) => console.log("Request Failed", err));

  if (!resultApi.data) {
    alert(
      "Ada yg eror. cek ulang nomer, jika nomer tidak ada yang salah berarti kena limit api"
    );
  } else {
    var cardNumber = "0";
    var cardNumberMap = "0";
    for (let i = 0; i < resultApi.data.packageInfo.length; i++) {
      const packageItem = resultApi.data.packageInfo[i];
      const packageName = packageItem[0].packages.name;
      const expDate = packageItem[0].packages.expDate;
      const paketName = packageName + " | Exp " + expDate;

      if (!packageItem[0].packages.message) {
        const col_lg_4 = document.createElement("div");
        col_lg_4.classList.add("col-md-4");
        col_lg_4.setAttribute("id", "col-md-4");
        const card = document.createElement("div");
        card.classList.add("card");
        card.classList.add("card" + cardNumber);

        const card_header = document.createElement("div");
        card_header.classList.add("card-header");
        card_header.classList.add("card-header" + cardNumber);
        document.getElementById("row").appendChild(col_lg_4);

        col_lg_4.appendChild(card);
        card.appendChild(card_header);

        document.querySelector(".card-header" + cardNumber).innerHTML =
          paketName;

        packageItem[0].benefits.map((item) => {
          let persenBar =
            (item.remaining.replace(/\D/g, "") /
              item.quota.replace(/\D/g, "")) *
            100;
          const num = persenBar;
          const first2Str = String(num).slice(0, 2);
          console.log(first2Str);

          // Create Element
          const list_group = document.createElement("ul");
          list_group.classList.add("list-group");
          list_group.classList.add("list-group-flush");
          list_group.setAttribute("id", "list-group");

          const list_group_item = document.createElement("li");
          list_group_item.classList.add("list-group-item");

          const remaining_content = document.createElement("div");
          remaining_content.classList.add("remaining-content");

          const nama_paket = document.createElement("p");
          nama_paket.classList.add("nama-paket");
          nama_paket.classList.add("nama-paket" + cardNumberMap);
          nama_paket.setAttribute("id", "nama-paket");

          const text_kuota = document.createElement("p");
          text_kuota.classList.add("text-quota");
          text_kuota.classList.add("text-quota" + cardNumberMap);

          const progress = document.createElement("div");
          progress.classList.add("progress");
          progress.setAttribute("style", "height : 5px");

          const progress_bar = document.createElement("div");
          progress_bar.classList.add("progress-bar");
          progress_bar.setAttribute("role", "progressbar");
          progress_bar.setAttribute("aria-label", "progressbar");
          progress_bar.setAttribute("aria-valuenow", "50");
          progress_bar.setAttribute("aria-valuemin", "0");
          progress_bar.setAttribute("aria-valuemax", "100");

          const text_remaining_quota = document.createElement("p");
          text_remaining_quota.classList.add("text-remaining-quota");
          text_remaining_quota.classList.add(
            "text-remaining-quota" + cardNumberMap
          );

          // Show Element
          document.querySelector(".card" + cardNumber).appendChild(list_group);
          list_group.appendChild(list_group_item);
          list_group_item.appendChild(remaining_content);
          remaining_content.appendChild(nama_paket);
          remaining_content.appendChild(text_kuota);
          list_group_item.appendChild(progress);
          progress.appendChild(progress_bar);
          list_group_item.appendChild(text_remaining_quota);

          if (persenBar > 100) {
            let persenNumber = "width : " + first2Str + "%";
            document;
            progress_bar.setAttribute("aria-valuenow", first2Str);
            progress_bar.setAttribute("style", persenNumber);
            // console.log(persenNumber);
          } else {
            let persenNumber = "width : " + persenBar + "%";
            progress_bar.setAttribute("aria-valuenow", first2Str);
            progress_bar.setAttribute("style", persenNumber);
            // console.log(persenNumber);
          }

          document.querySelector(".nama-paket" + cardNumberMap).innerText =
            item.bname;
          document.querySelector(
            ".text-remaining-quota" + cardNumberMap
          ).innerText = item.remaining;
          document.querySelector(".text-quota" + cardNumberMap).innerText =
            item.quota;
          cardNumberMap++;
        });
      } else {
        alert(packageItem[0].packages.message);
      }
      cardNumber++;
    }
  }

  const loading = document.getElementById("spinner-loading");
  loading.remove();
}

getData();
