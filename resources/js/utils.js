export function formToJson(form){
    var object = {}
    form.forEach((value, key) => object[key] = value)
    var json = JSON.stringify(object)

    return json
}