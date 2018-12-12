<?php

return [
    'alipay' => [
        'app_id'         => '2016092400581869',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2oLy5sulvNy4kxl0gqMjcTWOpX2Vhst4T0aEY4QAn91R2f+mWi51TDhTpoH6Me0JZDXQEobZY9pgBSDEBib8OLJ45G6uMdHomEh4Ss13gqRqpTapuRohab2/3g3LlhtPcQeF1RuU1rvdeMKPfNOKyTZKtQuI8b7FHqRiEymfrdnb7C8Ig8O3ywBlpahwpLLVGzGJiWf9swmJNNQIrWFaqiss3JRiq6G60G2823AzxsRhj9PF8pZBvZmoMKwqzbe2X5HFn6HEVG7SQerNu59cjIPghO5vT+KvPu8uheGTv1yqP2hjJTIiwAxg/Mi/MgzeFsRaoDZwI3BHhA1gajzN3QIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEAojKhqN7nyoqsoaK5USwb3xieaRcVHxkZy2TL5Clyprd2knfI5qlQWTPHaS6Lg2E1KpImhn+oFk8FqNxT5J6nomu2iFBjcNMjrMKWJFSxqKXh8ji9p5IKplTyQa/9kWHfelTWPz2/rOkXdEDTlShAKM1FdJJihLtdTeGsFGwTMuPkT0wM6tB2RSUvRANXdz64xx6EnYtAQC6r2CXGjMUlvSXJAVPJbzg0FH0+vUicqFM5WW5DLm68el0ItZirFn6IWAc1jcooPrw/eztuG78LuXSJYlq8pzaeE1G7EOHUbtEnI/6qy22BOFZvd6HsFZuseJgYcHC9/Nwa/jSIRgY8YwIDAQABAoIBAGcF1+7mXr4kpRApxqHLbYygG4ZOtgjBrcOmK2ep9/vzDipsUTxJkRKHtAKYIN97MATxPe0ySnaZDNQ71kGhkIK2/gLJZNA2HDPQiQNclFe1vbVX2wcD2SXbUODuQxZD32nZVxhmRUgz6cTapEnafh4sfBBWJqN+Sv57+AwktXEdklminocTpYPSZ+Ol9IxHahYlj7VUNFWbGRDxbiPrmEn0IdsPQfnv2cpMGgJP1pkWp8LrXOAwUcjgrWUhstMprabX4hArOeSWpH6KRj+HXN+Mdiian+t+KBUsos+V1ghqySwJT/GUNqEKbxWbYwItaAkZDn16Is18D803ey2nnGECgYEA0l5A85Ni1lTOLe6/MWzYT1C+Oxs+OPIm+6ZACUxdeATDlVBdTvISpPrNdRretHzZZAxXGxJTOwJHgy1pGOVVUiiV4GBVtE76D69Xm2Sp71WAhe8a5TYk46k1EhtpXljqT0q9AO6isLlN7rlxrAuRtXYJjEDMGmJMA89HgL9dLBECgYEAxWF5pdSmhpYUNQ8lgkGZ858gkcOpfmEkIJCW/vqkhiLrzMjZH/+qiGb4+aTQJhfZpIkQJaikiXZyA4Th/ayEkA/vB7nZICiBkEMOnXb8I9g4Y60zZ0Fbs4S68e6C1qL/u/ET+4btUFgPqq20N1JHWfbVqsQb64EJH8RMSDWYJTMCgYEAzOUwrg1nvwpqpyJa5nD1XotuPXOTbzOr9H9A782JXFSHiu7zcukkb7w4UU8SiwjvVBsQ3DVFC7x0mreoHa+BIryU/i3WTACAXraRxbCOM6Y7wDfbIlVSKMut/SzlvBcuYHyTCk1j+G0EEvhcVw4NpYiKVCjoouoKz8scAbJhtYECgYBhM3mGssw3Jx1Ya9ca6Fd6Y/jUD7keZZQ2/T1+38u5yuS4eoiCe5NtjNg7iHCA8enaXy02fnBYyZ2oIf5wwE6f61jZQyqr7YawlnVSElBlDovmelsAFG2mYEz3628/aBHsafJfQbkIgfVlJhnDzJ8arLXYXK8rMOZfYHn4bXw5hQKBgCSdseeaBqOlzulvcbsXpZdctVAaGKWHK0izUwkxUPZGaW91jydzkbQ6g4fZ13L5sbAkzJpAC9jPEpRyxjxszcz2OKTZWIlWVz6LUL0qQkW0CDREHiIBKOp3ZAzK1+MN4t99meVNihd/QqxwUAyQ+ts/WdLG+Qbb1yI3bJbIJ9p+',
        'log'            => [
            'file'  => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'   => '',
        'mch_id'   => '',
        'key'      => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ]
];