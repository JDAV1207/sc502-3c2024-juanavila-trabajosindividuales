function calculate() {
    const age = parseFloat(document.getElementById("age").value);
    let name = document.getElementById("name").value;
    let result = "";

    if (name == "") {
        alert("Por favor, ingrese su nombre");
        document.getElementById("result").innerText = result;
        return;
    }

    if (isNaN(age) || age < 0) {
        alert("Por favor, ingrese un numero valido");
        document.getElementById("result").innerText = result;
        return;
    }

    if(age >= 18){
        result = "eres mayor de edad";
    }else{
        result = "eres menor de edad";
    }
    

    document.getElementById("result").innerText = `${name} ${result}`;

}