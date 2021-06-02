define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "application/controllers/doc/main.js",
    "group": "/Users/williampalacios/Development/wbankingcompanyapi/application/controllers/doc/main.js",
    "groupTitle": "/Users/williampalacios/Development/wbankingcompanyapi/application/controllers/doc/main.js",
    "name": ""
  },
  {
    "type": "get",
    "url": "/cuentas/:numerocuenta",
    "title": "Solicitar la información de una cuenta",
    "version": "0.1.0",
    "name": "GetCuenta",
    "group": "Cuentas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "numerocuenta",
            "description": "<p>Número de cuenta de la cuenta solicitada.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "cuenta",
            "description": "<p>Información de la cuenta en formato JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"idcuenta\": 1,\n  \"numerocuenta\": \"1234567812345678\",\n  \"nip\": 1234,\n  \"idcuentahabiente\": 1,\n  \"nombre\": William\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "CuentaNoEncontrada",
            "description": "<p>La cuenta solicitada no fue encontrada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"CuentaNoEncontrada\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "application/controllers/v1/Cuentas.php",
    "groupTitle": "Cuentas",
    "sampleRequest": [
      {
        "url": "https://wbankingcompany.herokuapp.com/index.php/v1/cuentas/:numerocuenta"
      }
    ]
  },
  {
    "type": "get",
    "url": "/cuentas/:id/saldo",
    "title": "Solicitar el saldo de una cuenta",
    "version": "0.1.0",
    "name": "GetCuentaSaldo",
    "group": "Cuentas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID de la cuenta solicitada.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "saldo",
            "description": "<p>Información del saldo de la cuenta en formato JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"idhsaldo\": 5,\n  \"total\": 35000,\n  \"idcuenta\": 2,\n  \"fecha\": \"2021-05-29 11:06:41.851489-05\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "SaldoNoEncontrado",
            "description": "<p>El saldo de la cuenta solicitado no fue encontrado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"SaldoNoEncontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "application/controllers/v1/Cuentas.php",
    "groupTitle": "Cuentas",
    "sampleRequest": [
      {
        "url": "https://wbankingcompany.herokuapp.com/index.php/v1/cuentas/:id/saldo"
      }
    ]
  },
  {
    "type": "post",
    "url": "/cuentas/deposito",
    "title": "Realizar deposito a una cuenta",
    "version": "0.1.0",
    "name": "PostCuentaDeposito",
    "group": "Cuentas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID de la cuenta.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "total-depositado",
            "description": "<p>Total del monto que se depositará a la cuenta.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"idcuenta\": 2,\n  \"totalDepositado\": 5000\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "saldo",
            "description": "<p>Información del saldo actualizado de la cuenta en formato JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 CREATED\n{\n  \"idhsaldo\": 8,\n  \"total\": 40000,\n  \"idcuenta\": 2,\n  \"fecha\": \"2021-05-29 11:06:41.851489-05\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DatosIncorrectos",
            "description": "<p>Los datos proporcinados son incorrectos.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"DatosIncorrectos\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "application/controllers/v1/Cuentas.php",
    "groupTitle": "Cuentas",
    "sampleRequest": [
      {
        "url": "https://wbankingcompany.herokuapp.com/index.php/v1/cuentas/deposito"
      }
    ]
  },
  {
    "type": "post",
    "url": "/cuentas/retiro",
    "title": "Realizar retiro de una cuenta",
    "version": "0.1.0",
    "name": "PostCuentaRetiro",
    "group": "Cuentas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID de la cuenta.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "total-retirado",
            "description": "<p>Total del monto que se retirará de la cuenta.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"idcuenta\": 2,\n  \"totalRetirado\": 5000\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "saldo",
            "description": "<p>Información del saldo actualizado de la cuenta en formato JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 CREATED\n{\n  \"idhsaldo\": 9,\n  \"total\": 35000,\n  \"idcuenta\": 2,\n  \"fecha\": \"2021-05-29 11:06:41.851489-05\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DatosIncorrectos",
            "description": "<p>Los datos proporcinados son incorrectos.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "FondosInsuficientes",
            "description": "<p>No hay fondos suficientes para realizar la transacción.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"DatosIncorrectos\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Fondos insuficientes\n{\n  \"error\": \"FondosInsuficientes\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "application/controllers/v1/Cuentas.php",
    "groupTitle": "Cuentas",
    "sampleRequest": [
      {
        "url": "https://wbankingcompany.herokuapp.com/index.php/v1/cuentas/retiro"
      }
    ]
  },
  {
    "type": "post",
    "url": "/transferencias",
    "title": "Registrar transferencia de una cuenta a otra",
    "version": "0.1.0",
    "name": "PostTransferencias",
    "group": "Transferencias",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "idcuentahabiente",
            "description": "<p>ID de la cuenta de quien realiza la transferencia.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "idbeneficiario",
            "description": "<p>ID de la cuenta de quien recibe la transferencia.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "monto",
            "description": "<p>Monto total que se tranfiere de una cuenta a otra.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"idcuentahabiente\": 1,\n  \"idbeneficiario\": 2,\n  \"monto\": 15000\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "tranferencia",
            "description": "<p>Información de la transferencia en formato JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"idtransferencia\": 2,\n  \"idcuentahabiente\": 1,\n  \"idbeneficiario\": 2,\n  \"monto\": 15000\n  \"fecha\": \"2021-05-29 11:06:41.851489-05\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "DatosIncorrectos",
            "description": "<p>Los datos proporcinados son incorrectos.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"DatosIncorrectos\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "application/controllers/v1/Transferencias.php",
    "groupTitle": "Transferencias",
    "sampleRequest": [
      {
        "url": "https://wbankingcompany.herokuapp.com/index.php/v1/transferencias"
      }
    ]
  }
] });