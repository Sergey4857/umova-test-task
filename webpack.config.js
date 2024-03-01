const MiniCssExtractPlugin = require('mini-css-extract-plugin');
let mode = 'development'
if (process.env.NODE_ENV === 'production') {
    mode = 'production'
}

module.exports = {
    mode: mode,
    watchOptions: {
        aggregateTimeout: 200,
        poll: 1000,
    },
    output: {
        assetModuleFilename: "assets/[name][ext][query]",
        clean: true
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: mode ? "[name].css" : "[name].css",
        }),
    ],
    module: {
        rules: [
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    (mode === 'development') ? "style-loader" : MiniCssExtractPlugin.loader, "css-loader", {
                        loader: "postcss-loader",
                        options: {
                            postcssOptions: {
                                plugins: [
                                    [
                                        "autoprefixer",
                                        {
                                            // Options
                                        },
                                        "postcss-preset-env",
                                        {
                                            // Options
                                        },
                                    ],
                                ],
                            },
                        },
                    },
                    "sass-loader",
                ],
            },
            {
                test: /\.(png|jpg|gif|svg)$/i,
                type: 'asset/resource',
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
            },
        ]
    }

}