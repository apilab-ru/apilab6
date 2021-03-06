<?php

return [
    "source"=>[
        "add"=>[],
        "admin"=>[
            "css"=>[
                "/modules/admin/source/css/AdminLTE.css",
                "/modules/admin/source/css/skin-blue.css",
                "/modules/admin/source/css/skin-black.css",
                "/modules/admin/source/css/icon.css",
                "/modules/admin/source/css/admin.css"
            ],
            "js"=>[
                "/modules/admin/source/js/app.js",
                "/modules/admin/source/js/admin.js"
            ]
        ],
        "plugin"=>[
            "js"=>[
                "ckeditor"=>[
                    "/core/libs/ckeditor/setup.js",
                    "/core/libs/ckeditor/ckeditor.js"
                ],
                "datepicker"=>[
                    "/core/libs/datepicker/bootstrap-datepicker.js",
                    "/core/libs/datepicker/init.js"
                ],
                "datetimepicker"=>[
                    "/core/libs/datetimepicker/jquery.datetimepicker.full.min.js?1",
                    "/core/libs/datetimepicker/init.js?1"
                ],
                "ui"=>[
                    "/core/libs/ui/jquery-ui.min.js",
                    "/core/libs/ui/init.js"
                ],
                "nestable"=>[
                    "/core/libs/nestable/jquery.nestable.js",
                    "/core/libs/nestable/init.js"
                ]
           ]
        ]
    ]
];