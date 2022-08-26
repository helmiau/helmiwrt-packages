const headers = new Headers();
headers.append("pragma", "no-cache");
headers.append("cache-control", "no-cache");
const myInit = {
  method: "GET",
  headers,
};
async function getData() {
  let resultApi = "0";
  await fetch("./assets/data/nomer.json", myInit)
    .then((response) => response.json())
    .then((json) => (dataMentah = json))
    .catch((err) => console.log("Request Failed", err));

  $(document).ready(function () {
    $("#modalloader").modal("show");
  });
  var nomerKe = "0";
  for (dataMentahh of dataMentah.daftar) {
    // CREATE ELEMENT DAFTAR NOMER
    const cardModal = document.createElement("div");
    cardModal.classList.add("card");
    const form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "./controller.php");
    const inputGroup = document.createElement("div");
    inputGroup.classList.add("input-group");
    const cardBody = document.createElement("button");
    cardBody.setAttribute("type", "submit");
    cardBody.classList.add(
      "card-body",
      "btn",
      "btn-group",
      "btn-outline-secondary"
    );
    const row = document.createElement("div");
    row.classList.add("row");
    const spanNumber = document.createElement("span");
    spanNumber.classList.add("span-number");
    cardBody.setAttribute("name", "nomeraktif");
    const butttonDropdown = document.createElement("button");
    butttonDropdown.classList.add(
      "btn",
      "btn-outline-secondary",
      "dropdown-toggle",
      "dropdown-toggle-split"
    );
    butttonDropdown.setAttribute("type", "button");
    butttonDropdown.setAttribute("data-bs-toggle", "dropdown");
    butttonDropdown.setAttribute("aria-expanded", "false");
    const spanVisuallyHidden = document.createElement("span");
    spanVisuallyHidden.classList.add("visually-hidden");
    const formHps = document.createElement("form");
    formHps.setAttribute("method", "post");
    formHps.setAttribute("action", "./controller.php");
    const dropdownMenu = document.createElement("ul");
    dropdownMenu.classList.add("dropdown-menu");
    const li = document.createElement("li");
    const dropdownEdit = document.createElement("a");
    dropdownEdit.classList.add("dropdown-item");
    dropdownEdit.setAttribute("data-bs-toggle", "modal");
    dropdownEdit.setAttribute("data-bs-target", "#modaleditnomer");
    dropdownEdit.innerText = "Edit Nomer";
    const dropdownDivider = document.createElement("hr");
    dropdownDivider.classList.add("dropdown-divider");
    const dropdownHapus = document.createElement("button");
    dropdownHapus.classList.add("dropdown-item");
    dropdownHapus.setAttribute("type", "submit");
    dropdownHapus.setAttribute("name", "hapusnomer");
    dropdownHapus.innerText = "Hapus Nomer";

    // DISPLAY ELEMENT DAFTAR NOMER
    document.querySelector(".daftar-nomer").appendChild(cardModal);
    cardModal.appendChild(form);
    form.appendChild(inputGroup);
    inputGroup.appendChild(cardBody);
    cardBody.appendChild(row);
    row.appendChild(spanNumber);
    inputGroup.appendChild(butttonDropdown);
    butttonDropdown.appendChild(spanVisuallyHidden);
    inputGroup.appendChild(formHps);
    formHps.appendChild(dropdownMenu);
    dropdownMenu.appendChild(li);
    // li.appendChild(dropdownEdit);
    // dropdownMenu.appendChild(li);
    // li.appendChild(dropdownDivider);
    dropdownMenu.appendChild(li);
    li.appendChild(dropdownHapus);

    // DISPLAY DATA DAFTAR NOMER
    document.querySelectorAll(".span-number")[nomerKe].innerText =
      dataMentah.daftar[nomerKe];
    var nomer = document.querySelectorAll(".span-number")[nomerKe].innerText;
    cardBody.setAttribute("value", nomer);
    dropdownHapus.setAttribute("value", nomerKe);
    nomerKe++;
  }

  if (!dataMentah.aktif) {
    $(document).ready(function () {
      $("#modalloader").modal("hide");
    });
    const loading = document.getElementById("modalloader");
    loading.remove();
    $(document).ready(function () {
      $("#modalwelcome").modal("show");
    });
    // or
    return;
  }
  await fetch("https://apix.ardcs.my.id/cekxl?no=" + dataMentah.aktif, myInit)
    .then((response) => response.json())
    .then((json) => (resultApi = json))
    .catch((err) => console.log("Request Failed", err));

  if (resultApi.status == false) {
    $(document).ready(function () {
      $("#modalloader").modal("hide");
    });
    if(!resultApi.description){
      document.getElementById("erormsg").innerText =
        resultApi.result.errorMessage;
      $(document).ready(function () {
        $("#modaleror").modal("show");
      });
    } else {
      document.getElementById("erormsg").innerText =
        resultApi.description;
      $(document).ready(function () {
        $("#modaleror").modal("show");
      });
    }
    
  } else {
    var cardNumber = "0";
    var cardNumberMap = "0";
    for (let i = 0; i < resultApi.data.packageInfo.length; i++) {
      const packageItem = resultApi.data.packageInfo[i];
      const packageName = packageItem[0].packages.name;
      const expDate = packageItem[0].packages.expDate;

      if (!packageItem[0].packages.message) {
        if (cardNumber % 2 === 0) {
          // CREATE ELEMENT
          const col = document.createElement("div");
          col.classList.add("col");
          const card = document.createElement("div");
          card.classList.add("card", "card" + cardNumber);
          const cardHeader = document.createElement("div");
          cardHeader.classList.add("card-header");
          const cardTitle = document.createElement("h5");
          cardTitle.classList.add("card-title", "card-title" + cardNumber);
          const cardText = document.createElement("p");
          cardText.classList.add("card-text");
          cardText.classList.add("card-text" + cardNumber);
          const listGroup = document.createElement("ul");
          listGroup.classList.add(
            "list-group",
            "list-group-flush",
            "list-group" + cardNumber
          );

          // DISPLAY ELEMENT
          document.querySelector(".side-left").appendChild(col);
          col.appendChild(card);
          card.appendChild(cardHeader);
          card.appendChild(listGroup);
          cardHeader.appendChild(cardTitle);
          cardHeader.appendChild(cardText);

          // DISPLAY DATA TITLE AND TEXT
          document.querySelector(".card-title" + cardNumber).innerText =
            packageName;
          document.querySelector(".card-text" + cardNumber).innerText =
            "Akan berakhir pada tanggal " + expDate;

          // DATA ITEM
          packageItem[0].benefits.map((item) => {
            // CREATE ELEMENT
            const listGroupItem = document.createElement("li");
            listGroupItem.classList.add("list-group-item");
            const remainingContent = document.createElement("div");
            remainingContent.classList.add("remaining-content");
            const namaPaket = document.createElement("p");
            namaPaket.classList.add("nama-paket", "nama-paket" + cardNumberMap);
            const textQuota = document.createElement("p");
            textQuota.classList.add("text-quota", "text-quota" + cardNumberMap);
            const progress = document.createElement("div");
            progress.classList.add("progress");
            const progressBar = document.createElement("div");
            progressBar.classList.add("progress-bar");
            progressBar.setAttribute("role", "progressbar");
            progressBar.setAttribute("aria-label", "progressbar");
            progressBar.setAttribute("aria-valuemax", "100");
            const textRemainingQuota = document.createElement("p");
            textRemainingQuota.classList.add(
              "text-remaining-quota",
              "text-remaining-quota" + cardNumberMap
            );

            // DISPLAY ELEMENT
            document
              .querySelector(".list-group" + cardNumber)
              .appendChild(listGroupItem);
            listGroupItem.appendChild(remainingContent);
            remainingContent.appendChild(namaPaket);
            remainingContent.appendChild(textQuota);
            listGroupItem.appendChild(progress);
            progress.appendChild(progressBar);
            listGroupItem.appendChild(textRemainingQuota);

            // DATA PERSEN ITEM
            let persenBar =
              (item.remaining.replace(/\D/g, "") /
                item.quota.replace(/\D/g, "")) *
              100;
            const num = persenBar;
            const first2Str = String(num).slice(0, 2);
            // DISPLAY PERSEN DATA
            if (persenBar > 100) {
              let persenNumber = "width : " + first2Str + "%";
              document;
              progressBar.setAttribute("aria-valuenow", first2Str);
              progressBar.setAttribute("style", persenNumber);
            } else {
              let persenNumber = "width : " + persenBar + "%";
              progressBar.setAttribute("aria-valuenow", first2Str);
              progressBar.setAttribute("style", persenNumber);
            }

            // DISPLAY DATA
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
          // CREATE ELEMENT
          const col = document.createElement("div");
          col.classList.add("col");
          const card = document.createElement("div");
          card.classList.add("card", "card" + cardNumber);
          const cardHeader = document.createElement("div");
          cardHeader.classList.add("card-header");
          const cardTitle = document.createElement("h5");
          cardTitle.classList.add("card-title", "card-title" + cardNumber);
          const cardText = document.createElement("p");
          cardText.classList.add("card-text");
          cardText.classList.add("card-text" + cardNumber);
          const listGroup = document.createElement("ul");
          listGroup.classList.add(
            "list-group",
            "list-group-flush",
            "list-group" + cardNumber
          );

          // DISPLAY ELEMENT
          document.querySelector(".side-right").appendChild(col);
          col.appendChild(card);
          card.appendChild(cardHeader);
          card.appendChild(listGroup);
          cardHeader.appendChild(cardTitle);
          cardHeader.appendChild(cardText);

          // DISPLAY DATA TITLE AND TEXT
          document.querySelector(".card-title" + cardNumber).innerText =
            packageName;
          document.querySelector(".card-text" + cardNumber).innerText =
            "Akan berakhir pada tanggal " + expDate;

          // DATA ITEM
          packageItem[0].benefits.map((item) => {
            // CREATE ELEMENT
            const listGroupItem = document.createElement("li");
            listGroupItem.classList.add("list-group-item");
            const remainingContent = document.createElement("div");
            remainingContent.classList.add("remaining-content");
            const namaPaket = document.createElement("p");
            namaPaket.classList.add("nama-paket", "nama-paket" + cardNumberMap);
            const textQuota = document.createElement("p");
            textQuota.classList.add("text-quota", "text-quota" + cardNumberMap);
            const progress = document.createElement("div");
            progress.classList.add("progress");
            const progressBar = document.createElement("div");
            progressBar.classList.add("progress-bar");
            progressBar.setAttribute("role", "progressbar");
            progressBar.setAttribute("aria-label", "progressbar");
            progressBar.setAttribute("aria-valuemax", "100");
            const textRemainingQuota = document.createElement("p");
            textRemainingQuota.classList.add(
              "text-remaining-quota",
              "text-remaining-quota" + cardNumberMap
            );

            // DISPLAY ELEMENT
            document
              .querySelector(".list-group" + cardNumber)
              .appendChild(listGroupItem);
            listGroupItem.appendChild(remainingContent);
            remainingContent.appendChild(namaPaket);
            remainingContent.appendChild(textQuota);
            listGroupItem.appendChild(progress);
            progress.appendChild(progressBar);
            listGroupItem.appendChild(textRemainingQuota);

            // DATA PERSEN ITEM
            let persenBar =
              (item.remaining.replace(/\D/g, "") /
                item.quota.replace(/\D/g, "")) *
              100;
            const num = persenBar;
            const first2Str = String(num).slice(0, 2);

            // DISPLAY PERSEN DATA
            if (persenBar > 100) {
              let persenNumber = "width : " + first2Str + "%";
              document;
              progressBar.setAttribute("aria-valuenow", first2Str);
              progressBar.setAttribute("style", persenNumber);
            } else {
              let persenNumber = "width : " + persenBar + "%";
              progressBar.setAttribute("aria-valuenow", first2Str);
              progressBar.setAttribute("style", persenNumber);
            }

            // DISPLAY DATA
            document.querySelector(".nama-paket" + cardNumberMap).innerText =
              item.bname;
            document.querySelector(
              ".text-remaining-quota" + cardNumberMap
            ).innerText = item.remaining;
            document.querySelector(".text-quota" + cardNumberMap).innerText =
              item.quota;
            cardNumberMap++;
          });
        }
        //
      } else {
        $(document).ready(function () {
          $("#modalloader").modal("hide");
        });
        document.getElementById("erormsg").innerText =
          packageItem[0].packages.message +
          "\n\n Update terakhir:  " +
          resultApi.data.lastUpdate;
        $(document).ready(function () {
          $("#modaleror").modal("show");
        });
      }
      cardNumber++;
    }
  }
  $(document).ready(function () {
    $("#modalloader").modal("hide");
  });
}
getData();
