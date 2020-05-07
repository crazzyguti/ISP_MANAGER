var encoder = new TextEncoder('utf-8');

// Algorithm Object
var algorithmKeyGen = {
    name: "RSASSA-PKCS1-v1_5",
    // RsaHashedKeyGenParams
    modulusLength: 2048,
    publicExponent: new Uint8Array([0x01, 0x00, 0x01]), // Equivalent to 65537
    hash: {
        name: "SHA-256"
    }
};

var algorithmSign = {
    name: "RSASSA-PKCS1-v1_5"
};

window.crypto.subtle.generateKey(algorithmKeyGen, false, ["sign"]).then(
    function (key) {
        var dataPart1 = encoder.encode("hello,");
        var dataPart2 = encoder.encode(" world!");

        return window.crypto.subtle.sign(algorithmSign, key.privateKey, [dataPart1, dataPart2]);
    },
    console.error.bind(console, "Unable to generate a key")
).then(
    console.log.bind(console, "The signature is: "),
    console.error.bind(console, "Unable to sign")
);
