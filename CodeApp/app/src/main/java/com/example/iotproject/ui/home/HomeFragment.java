package com.example.iotproject.ui.home;

import static java.lang.Thread.sleep;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.http.SslError;
import android.os.Bundle;
import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.SslErrorHandler;
import android.webkit.WebResourceError;
import android.webkit.WebResourceRequest;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;

import android.graphics.Bitmap;
import android.widget.ImageView;
import android.widget.TextView;


import com.bumptech.glide.Glide;
import com.example.iotproject.databinding.FragmentHomeBinding;

import java.util.Timer;
import java.util.TimerTask;


public class HomeFragment extends Fragment {
    private FragmentHomeBinding binding;

    String ShowOrHideWebViewInitialUse = "show";
    public WebView webView;

    private ImageView Icon;
    private ImageView Logo;
    private ImageView GifView;
    private TextView WarningText;

    boolean LoadError = false;

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        HomeViewModel homeViewModel =
                new ViewModelProvider(this).get(HomeViewModel.class);
        binding = FragmentHomeBinding.inflate(inflater, container, false);
        View root = binding.getRoot();

        webView = binding.webView;
        Icon = binding.imageView2;
        Logo = binding.imageView3;
        GifView = binding.loadinggif;
        WarningText = binding.warning;

        Logo.setVisibility(View.GONE);


//        WarningText.setVisibility(View.VISIBLE);

        Glide.with(this).load("file:///android_asset/LoadingGif3.gif").into(binding.loadinggif);

        Timer timer = new Timer();
        timer.schedule(new TimerTask()
        {
            @Override
            public void run() {
                ConnectivityManager connectivityManager = (ConnectivityManager)
                        getActivity().getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo wifi = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
                NetworkInfo mobileNetwork = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

                if(wifi.isConnected() || mobileNetwork.isConnected()){
                    getActivity().runOnUiThread(()->{
                        WarningText.setVisibility(View.GONE);
                        if(LoadError){
//                            webView.reload();
                            LoadError = false;
                        }
                    });
                }
                else{
                    getActivity().runOnUiThread(()->{
                        WarningText.setVisibility(View.VISIBLE);

                    });
                }
            }
        }, 0, 500);

        checkConnection();

        return root;
    }


    public void loadWebView(){
        webView.setVisibility(View.INVISIBLE);
        webView.setWebViewClient(new CustomWebViewClient());
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setDomStorageEnabled(true);

//        webView.getSettings().getJavaScriptCanOpenWindowsAutomatically();

        webView.loadUrl("https://nckh.assfa.net");

//        webView.loadUrl("https://vuongtansi.assfa.net/");
//        webView.loadUrl("http://app1.iotvision.vn/");
//        webView.loadUrl("https://dfm.ptthebc.com.vn/assets/");
//        webView.loadUrl("file:///android_asset/index.html");
    }

    public void checkConnection(){
        ConnectivityManager connectivityManager = (ConnectivityManager)
                getActivity().getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo wifi = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
        NetworkInfo mobileNetwork = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

        if(wifi.isConnected()){
            loadWebView();
        }
        else if (mobileNetwork.isConnected()){
            loadWebView();
        }
        else{
            webView.setVisibility(View.GONE);
            GifView.setVisibility(View.GONE);
            WarningText.setVisibility(View.VISIBLE);
        }
    }

    // This allows for a splash screen
    // (and hide elements once the page loads)
    private class CustomWebViewClient extends WebViewClient implements com.example.iotproject.ui.home.CustomWebViewClient {
        @Override
        public void onPageStarted(WebView webview, String url, Bitmap favicon) {
            WarningText.setVisibility(View.GONE);
            webview.setVisibility(View.INVISIBLE);
        }

        @Override
        public void onPageFinished(WebView view, String url) {
            WarningText.setVisibility(View.GONE);

            Handler handler = new Handler();
            handler.postDelayed(new Runnable() {
                @Override
                public void run() {
                    //làm sau khi delay
                    //ShowOrHideWebViewInitialUse = "hide";
                    Icon.setVisibility(View.GONE);
                    Logo.setVisibility(View.GONE);
                    GifView.setVisibility(View.GONE);
//                    WarningText.setVisibility(View.VISIBLE);
                    view.setVisibility(View.VISIBLE);
                }
            }, 500);

            super.onPageFinished(view, url);
        }


        @Override
        public void onReceivedSslError(WebView view, SslErrorHandler handler, SslError error) {
            handler.proceed(); // Ignore SSL certificate errors
        }

        @Override
        public void onReceivedError(WebView view, WebResourceRequest request, WebResourceError error){
            WarningText.setVisibility(View.VISIBLE);
            LoadError = true;
        }

    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }
}